<?php

namespace App\Http\Controllers\Frontend\User;

use DateTime;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Credit;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Models\DatingProfile;
use App\Models\UserTotalCredit;
use App\Http\Controllers\Controller;

class UserEventController extends Controller
{
    public function index(Request $request)
    {
        $events = $request->user()->events()->orderBy('start_datetime', 'asc')->paginate(2);

        $events_all = Event::get();
        $get_today_event;
        $valid = '';
        foreach ($events_all as $event) {
            $get_today_event = $event->whereDate('start_datetime',Carbon::now()->addDay(-1))->first();
            if(!$get_today_event){
                $get_today_event = $event->whereDate('start_datetime',Carbon::today())->first();
            }

        }
        if($get_today_event){
            if($get_today_event->start_datetime->format('dd-mm-yyyy') == Carbon::now()->format('dd-mm-yyyy')){
                $end =$get_today_event->start_datetime->createFromTimeString('05:00:00')->addDay(1);
            }
            else{
                $end =$get_today_event->start_datetime->createFromTimeString('05:00:00');
            }
        }
        if($get_today_event){
            $new_end = new DateTime($end);
            $new_carbon = new DateTime(Carbon::now());
            if ($new_end > $new_carbon) {

                $valid = $get_today_event->id;
            }
        }
        // dd($valid);
        $now_time = new DateTime(Carbon::now());
        return view('frontend.user.events.index', compact('events', 'valid', 'now_time'));
    }

    public function hourCheck(Request $request)
    {
        $get_event = Event::whereId($request->event_id)->first();
        $sub_hours = $get_event->start_datetime->subDays(2);
        $today = Carbon::now();
        // dd($sub_hours, $today);
        if($today <= $sub_hours)
        {
            return 'yes';
        }
        else{
            return 'no';
        }
        return view('hourCheck');
    }
    public function cancelEvent(Request $request)
    {
        $get_event = Event::whereId($request->event_id)->first();
        $sub_hours = $get_event->start_datetime->subDays(2);
        $today = Carbon::now();
        $total_credit_get = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
        // dd($sub_hours, $today);
        if($today <= $sub_hours)
        {
            $check_record = Credit::where('user_id', auth()->user()->id)->first();
            $gender_check = DatingProfile::where('user_id', auth()->user()->id)->first();
                $new_record = new Credit();
                if($gender_check->gender == '0') //Male
                {
                    $new_record->balance = $get_event->price_male;
                    $new_record->user_id = auth()->user()->id;
                    $new_record->event_id = $request->event_id;
                    $new_record->count = 1;
                    $new_record->save();
                }
                if($gender_check->gender == '1') //Female
                {
                    $new_record->balance = $get_event->price_female;
                    $new_record->user_id = auth()->user()->id;
                    $new_record->event_id = $request->event_id;
                    $new_record->count = 1;
                    $new_record->save();
                }
            // }
            $credits = Credit::where('user_id', auth()->user()->id)->with('events')->get();
            if($total_credit_get){
                $total_credit_get->count = $total_credit_get->count + 1;
                $total_credit_get->save();
            }
            else{
                $total_credit_get_new = new UserTotalCredit();
                $total_credit_get_new->user_id = auth()->user()->id;
                $total_credit_get_new->count = 1;
                $total_credit_get_new->save();
            }
            $credit_first = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
            $credit_count = $credit_first->count;
            // $credit_count = UserTotalCredit::where('user_id', auth()->user()->id)->count();
            $event_user = EventUser::where('user_id' , auth()->user()->id)->where('event_id',$get_event->id)->delete();
            return redirect()->back()->withFlashSuccess('Successfully Cancelled');
        }
        else{
            $credits = Credit::where('user_id', auth()->user()->id)->with('events')->get();
            if(!$total_credit_get){
                $total_credit_get_new = new UserTotalCredit();
                $total_credit_get_new->user_id = auth()->user()->id;
                $total_credit_get_new->count = 0;
                $total_credit_get_new->save();
            }
            $credit_first = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
            $credit_count = $credit_first->count;
            $event_user = EventUser::where('user_id' , auth()->user()->id)->where('event_id',$get_event->id)->delete();
            return redirect()->back()->withFlashSuccess('Successfully Cancelled');
        }
    }
}
