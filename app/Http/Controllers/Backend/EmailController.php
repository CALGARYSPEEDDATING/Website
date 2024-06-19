<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Auth\User;
use App\Models\EventUser;
use App\Models\EmailSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Backend\IndividualMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\Backend\EmailByAgeGroup;
use App\Mail\Backend\EmailWithOwnSubject;

class EmailController extends Controller
{
    public function byAgeGender()
    {
        $events = Event::notExpired()->approved()->upcoming()->get();
        return view('backend.emails.by_age_gender', compact('events'));
    }

    public function postByAgeGender(Request $request)
    {
        $age_range = explode(';', $request->user_age_range);
        $minAge = $age_range[0];
        $maxAge = $age_range[1];
        $minDate = Carbon::today()->subYears($maxAge)->format('Y-m-d');
        $maxDate = Carbon::today()->subYears($minAge)->format('Y-m-d');
        $event = Event::find($request->event_id);
        $gender = $request->gender;
        $description = $request->description;
        // $subject = '';
        //     if($request->subject){
        //         $subject = $request->subject;
        //         // dd($request->description);
        //         $email_subject = EmailSubject::where('subject', $request->subject)->first();
        //         if(!$email_subject){
        //             $email_subject = new EmailSubject();
        //             $email_subject->subject = $request->subject;
        //             $email_subject->save();
        //         }
        // }
        $users = User::role(['user'])->whereBetween('dob', [$minDate, $maxDate])->whereHas('profile', function ($q) use ($gender) {
            $q->where('gender', $gender);
        })->get();
        $abc=array();
        foreach ($users as $user) {
            $check_user=EventUser::where('event_id',$request->event_id)->where('user_id',$user->id)->first();
            if(!$check_user){
                // if($subject){
                //     Mail::to($user->email)->send(new EmailByAgeGroup($user, $event, $description, $subject));
                // }
                // else{
                    Mail::to($user->email)->send(new EmailByAgeGroup($user, $event, $description, $event->title));
                // }
            }

            // Mail::to('info@calgaryspeeddating.com')->send(new EmailByAgeGroup($user, $event, $description)); send 
            // return (new EmailByAgeGroup($user, $event, $description))->render();
        }
        $main_user = User::where('id', 1)->first();
        // if($subject){
        //     Mail::to('info@calgaryspeeddating.com')->send(new EmailByAgeGroup($main_user, $event, $description, $subject));
        // }
        // else{
            Mail::to('info@calgaryspeeddating.com')->send(new EmailByAgeGroup($main_user, $event, $description, $event->title));
        // }
        return redirect()->back()->withFlashSuccess('Email successful sent');
        // dd($users);
    }

    public function autosubject(Request $request)
    {
        if ($request->ajax()) {
            $data = EmailSubject::where('subject','LIKE','%'.$request->subject.'%')->get();
            $output = '';
            if (count($data)>0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">'.$row->subject.'</li>';
                }
                $output .= '</ul>';
            }
            return $output;
        }
        return view('autosubject');  
    }

    public function ownSubject()
    {
        return view('backend.emails.own_subject');
    }

    public function postOwnSubject(Request $request)
    {
        $age_range = explode(';', $request->user_age_range);
        $minAge = $age_range[0];
        $maxAge = $age_range[1];
        $minDate = Carbon::today()->subYears($maxAge)->format('Y-m-d');
        $maxDate = Carbon::today()->subYears($minAge)->format('Y-m-d');
        $gender = $request->gender;
        $description = $request->description;
        $subject = '';
            if($request->subject){
                $subject = $request->subject;
                $email_subject = EmailSubject::where('subject', $request->subject)->first();
                if(!$email_subject){
                    $email_subject = new EmailSubject();
                    $email_subject->subject = $request->subject;
                    $email_subject->save();
                }
        }
        $users = User::role(['user'])->whereBetween('dob', [$minDate, $maxDate])->whereHas('profile', function ($q) use ($gender) {
            $q->where('gender', $gender);
        })->get();
        $abc=array();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new EmailWithOwnSubject($user, $description, $subject, $minAge, $maxAge));
        }
        $main_user = User::where('id', 1)->first();

        Mail::to('info@calgaryspeeddating.com')->send(new EmailWithOwnSubject($main_user, $description, $subject, $minAge, $maxAge));
        // dd($users);
    }

    public function individualMail()
    {
        $events = Event::notExpired()->approved()->upcoming()->get();
        return view('backend.emails.individual_mail', compact('events'));
    }

    public function postIndividualMail(Request $request)
    {
        $event = Event::whereId($request->event)->first();
        foreach ($request->user_select as $user) {
            $get_user = User::whereId($user)->first();
            Mail::to($get_user->email)->send(new IndividualMail($get_user, $request->description, $event));
        }
        return back()->withFlashSuccess('Email successful sent');
    }

    public function getEventUser(Request $request)
    {
        $eventUser = EventUser::where('event_id', $request->event)->with('users')->get();
        return $eventUser;
    }
}
