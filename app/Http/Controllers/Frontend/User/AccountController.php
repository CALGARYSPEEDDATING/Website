<?php

namespace App\Http\Controllers\Frontend\User;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Credit;
use App\Models\Payment;
use App\Models\Auth\User;
use App\Models\Countdown;
use App\Models\EventUser;
use App\Models\UserMatch;
use Illuminate\Http\Request;
use App\Models\DatingProfile;
use App\Models\EmailTracking;
use App\Models\UserTotalCredit;
use App\Http\Controllers\Controller;
use App\Models\Auth\PasswordHistory;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\AccountDeletion;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::get();
        $get_today_event;
        $valid = '';
        $end = '';
        $logged_user = '';
        $user_auth_check = '';
        foreach ($events as $event) {
            $get_today_event = $event->whereDate('start_datetime',Carbon::now()->addDay(-1))->first();
            if(!$get_today_event){
                $get_today_event = $event->whereDate('start_datetime',Carbon::today())->first();
            }

        }
        if($get_today_event){
            if($get_today_event->start_datetime->format('dd-mm-yyyy') ==Carbon::now()->format('dd-mm-yyyy')){
                $end =$get_today_event->start_datetime->createFromTimeString('12:00:00')->addDay(1);
            }
            else{
                $end =$get_today_event->start_datetime->createFromTimeString('12:00:00');
            }
        }
        if($get_today_event){
            $user_auth_check = EventUser::where('event_id', $get_today_event->id)->where('user_id', auth()->user()->id)->first();
            if($get_today_event->start_datetime->addHour(2) < Carbon::now()){
                if (Carbon::now()->between($get_today_event->start_datetime->addHour(2) , $end)) {

                    $valid = 'yes';
                    return view('frontend.user.account', compact('end', 'valid', 'user_auth_check'));
                }
            }
            else{
                $valid = 'no';
                return view('frontend.user.account', compact('end', 'valid', 'user_auth_check'));
            }
        }
        return view('frontend.user.account', compact('end', 'valid', 'user_auth_check'));

    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.profile', compact('user'));
    }
    public function matchUpdate(Request $request)
    {
        UserMatch::where('liked_user_id', $request->matchid)->where('user_id', $request->userid)
            ->update(['comment' => $request->match_comment]);
        return back()->withFlashSuccess('Match comment updated');
    }
    public function accountDelete($id){
        $user=User::where('id',$id)->first();
        Countdown::where('user_id',$id)->delete();
        Credit::where('user_id',$id)->delete();
        DatingProfile::where('user_id',$id)->delete();
        EmailTracking::where('user_id',$id)->delete();
        EventUser::where('user_id',$id)->delete();
        UserMatch::where('user_id',$id)->delete();
        UserMatch::where('liked_user_id',$id)->delete();
        Payment::where('user_id',$id)->delete();
        UserTotalCredit::where('user_id',$id)->delete();
        PasswordHistory::where('user_id',$id)->delete();
        User::where('id',$id)->forceDelete();
        Mail::to($user->email)->send(new AccountDeletion($user));
        // if($user){
        //     $user->email = $user->email . ' ' . str_random(30);
        //     $user->save();
        // }
        return redirect()->route('frontend.accountDeletedSuccess')->with('message', 'Account is deleted!');
    }

    public function accountDeletedSuccess()
    {
        return view('frontend.user.accountDeleted');
    }
}
