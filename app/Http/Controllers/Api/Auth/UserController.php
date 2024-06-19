<?php

namespace App\Http\Controllers\Api\Auth;
use DB;
// use Illuminate\Support\Facades\Auth;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\Event;

use App\Models\Auth\User;
use App\Models\EventUser;
use App\Models\UserMatch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Backend\Feedback;
use App\Mail\Backend\EventsNoLikes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Backend\EventsNoMatches;
use App\Mail\Backend\EventsSingleMatch;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Mail\Backend\EventsMultipleMatches;
use Illuminate\Validation\Rules\Password as RulesPassword;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [ 
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $token = auth()->user()->createApiToken(); #Generate token
            return response()->json(['status' => 'Authorised', 'token' => $token ], 200);
        } else { 
            return response()->json(['status'=>'Unauthorised'], 401);
        } 
    }

    public function pinCode(Request $request){
        $validator = Validator::make($request->all(), [ 
            'pin' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $get_user = User::where('pincode', $request->pin)->first();
        if($get_user){ 
            // if(Auth::attempt(['email' => $get_user->email])){
                $token = $get_user->createApiToken(); #Generate token
                return response()->json(['status' => 'Authorised', 'token' => $token ], 200);
            // } 
        } else { 
            return response()->json(['status'=>'Unauthorised'], 401);
        } 
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', request()->input('email'))->first();
        if($user){
            $token = Password::getRepository()->create($user);
            // $user->sendPasswordResetNotification($token);
            return [
                'token' => $token
            ];
        }
        else{
            return [
                'result' => 'Email not found'
            ];
        }
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // if ($status == Password::RESET_LINK_SENT) {
        //     return [
        //         'status' => __($user),
        //         'token' => $token
        //     ];
        // }

        // throw ValidationException::withMessages([
        //     'email' => [trans($status)],
        // ]);
    }

    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                    
                // $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }

    public function getUserProfile(Request $request){
        $user = Auth::user();
        
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function getUserMatches($id)
    {
        $event_date_check = Event::whereId($id)->first();
        if($event_date_check->start_datetime <= Carbon::now()->addDay(1)){
            $auth_user = Auth::user();
            $users  =  DB::table('users')
                        ->select('users.id', 'users.first_name', 'users.last_name', 'users.avatar_location', 'event_user.gender as gender', 'dating_profiles.question_one as question_one' , 'dating_profiles.question_two as question_two' , 'dating_profiles.question_three as question_three' , 'dating_profiles.question_four as question_four')
                        ->join('event_user','event_user.user_id','users.id')
                        ->join('dating_profiles','dating_profiles.user_id','users.id')
                        ->where('event_user.event_id',$id)
                        ->where('event_user.wait_list',0)
                        ->orderBy('event_user.gender', 'desc')
                        ->get();

            $match_checked = UserMatch::where('event_id', $id)->where('user_id', $auth_user->id)->get();
                        
            return response()->json(['success' => $users, 'User Match' => $match_checked], $this->successStatus);
        }
        else{
            return response()->json(['success' => 'No Result', 'User Match' => 'No Result'], $this->successStatus);
        }
    }

    public function SubmitUserMatches(Request $request){
        $get_match_user = UserMatch::where('user_id', auth()->user()->id)
                                    ->where('event_id', $request->event_id)
                                    ->get();        
        $user_login = Auth::user();
        foreach($get_match_user as $get_user){
            $get_user->delete();
        }
        $get_like_match_user = UserMatch::where('liked_user_id', auth()->user()->id)
        ->where('event_id', $request->event_id)
        ->get();
        foreach($get_like_match_user as $get_like_user){
            $get_like_user->matched=0;
            $get_like_user->save();
        }
        if($request->user_like){
            foreach($request->user_like as $key => $user_chk){
                $ids = $user_login->likesToUsers()->pluck('user_id');
                try {
                    $mutual_like = UserMatch::where('liked_user_id', auth()->user()->id)
                        ->where('user_id', $user_chk)
                        ->where('event_id', $request->event_id)
                        ->first();
                        $match = new UserMatch();
                        $match->user_id = auth()->user()->id;
                        $match->liked_user_id = $user_chk;
                        $match->event_id = $request->event_id;
                        $match->matched = $mutual_like ? 1 : 0;
                        //new added 195 to 198
                        if($request->comment)
                            $match->comment = $request->comment[$key];
                        else
                            $match->comment = '';
                        $match->save();
                    
                    if ($mutual_like) {
                        $mutual_like->matched = 1;
                        $mutual_like->save();
                    }
                    
                }catch (Exception $e) {}
                
            }
        }
        
        return response()->json(['success' => 'Match Created'], $this->successStatus);
    }

    public function getUserEvent()
    {
        $events = Event::get();
        $get_today_event;
        $user = Auth::user();
        $get_event_start = '';
        $end = '';
        foreach ($events as $event) {
            $get_today_event = $event->whereDate('start_datetime',Carbon::now()->addDay(-1))->first();
            if(!$get_today_event){
                $get_today_event = $event->whereDate('start_datetime',Carbon::today())->first();
            }
            
        }
        if($get_today_event){
            if($get_today_event->start_datetime->format('d-m-Y') ==Carbon::now()->format('d-m-Y')){
                $end =$get_today_event->start_datetime->createFromTimeString('12:00:00')->addDay(1);
                $eventUser = EventUser::where('user_id', $user->id)->where('event_id', $get_today_event->id)->first();
                if($eventUser){
                    // array_push($get_event_start, $get_user_event);
                    $get_event_start = $get_today_event;
                }
            }
            else{
                $end =$get_today_event->start_datetime->createFromTimeString('12:00:00');
                if($end < Carbon::now()){
                    $get_event_start = '';
                }
                else{
                    $eventUser = EventUser::where('user_id', $user->id)->where('event_id', $get_today_event->id)->first();
                    if($eventUser){
                        // array_push($get_event_start, $get_user_event);
                        $get_event_start = $get_today_event;
                    }
                }
            }
        }
        

        //// foreach ($all_event as $all_event) {
            //// $get_user_events = Event::whereDate('start_datetime', '<=', $today)->whereDate('end_datetime', '>=', $today)->get();
            
            //old logic

            // $get_user_events = Event::whereDate('start_datetime',  $today)->get();
            //// $get_user_events = Event::whereBetween('start_datetime', [$today ,$all_event->end_datetime])->get();
            // if($get_user_events){
            //     foreach($get_user_events as $get_user_event){
            //         $eventUser = EventUser::where('user_id', $user->id)->where('event_id', $get_user_event->id)->first();
            //         if($eventUser){
            //             // array_push($get_event_start, $get_user_event);
            //             $get_event_start = $get_user_event;
            //         }
            //     }
            // }
        //// }
        if($get_event_start)
            return response()->json(['success' => $get_event_start], $this->successStatus);
        else
            return response()->json(['success' => 'No Event'], $this->successStatus);
    }

    // public function getUserEvent()
    // {
    //     $user = Auth::user();
    //     $today = date(Carbon::now()->toDateString());
    //     // $all_event = Event::all();
    //     $get_event_start = '';
    //     // foreach ($all_event as $all_event) {
    //         // $get_user_events = Event::whereDate('start_datetime', '<=', $today)->whereDate('end_datetime', '>=', $today)->get();
    //         $get_user_events = Event::whereDate('start_datetime',  $today)->get();
    //         // $get_user_events = Event::whereBetween('start_datetime', [$today ,$all_event->end_datetime])->get();
    //         if($get_user_events){
    //             foreach($get_user_events as $get_user_event){
    //                 $eventUser = EventUser::where('user_id', $user->id)->where('event_id', $get_user_event->id)->first();
    //                 if($eventUser){
    //                     // array_push($get_event_start, $get_user_event);
    //                     $get_event_start = $get_user_event;
    //                 }
    //             }
    //         }
    //     // }
    //     if($get_event_start)
    //         return response()->json(['success' => $get_event_start], $this->successStatus);
    //     else
    //         return response()->json(['success' => 'No Event'], $this->successStatus);
    // }

    public function completeMatches($id)
    {
        $event = Event::findOrFail($id);
        $mail_counter = 0;
        $event_users = UserMatch::where('event_id', $event->id)->get();
        foreach($event_users as $event_user){
            $user = User::find($event_user->user_id);
            $ids = $user->likesToUsers()->pluck('user_id');
            $mutual_like = UserMatch::where('liked_user_id', $event_user->user_id)
                            ->where('user_id', $event_user->liked_user_id)
                            ->where('event_id', $event->id)
                            ->first();
            if ($mutual_like) {
                $match_user = User::find($mutual_like->user_id);
                $matches = $user->matches($event->id)->get();
                $match_count = $user->matches($event->id)->count();

                if ($match_count > 1) {
                    Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
                    Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                    $mail_counter = 1;
                } else {
                    Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
                    Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                    $mail_counter = 1;
                }
            }
        }
        $users = $event->users()->whereWaitList(0)->orderBy('pivot_created_at', 'desc')->get();
        foreach ($users as $user) {
            $likes = $user->likesFromUsers()->where('event_id', $event->id)->count();
            $matches = $user->matches($event->id)->count();
            if (!$matches) {
                if ($likes) {
                    Mail::to($user->email)->send(new EventsNoMatches($user, $likes));
                    $mail_counter = 1;
                } else {
                    Mail::to($user->email)->send(new EventsNoLikes($user));
                    $mail_counter = 1;
                }
            }
        }
        if($mail_counter == 1){
            return response()->json(['result' => 'Email Sent'], $this->successStatus);
        }
        else  
            return response()->json(['result' => 'Email not sent'], $this->successStatus);
    }

    public function submitFeedback(Request $request)
    {
        $feedback = $request->feedback;
        Mail::to('info@calgaryspeeddating.com')->send(new Feedback($feedback));
        return response()->json(['success' => 'Feedback Sent'], $this->successStatus);
    }

    public function userEventsList()
    {
        $events = Event::get();
        $user = Auth::user();
        $yesterday = Carbon::now()->addDay(-1);
        $eventUser = EventUser::where('user_id', $user->id)->with(['events' => function($q) use($yesterday){
            // Query the name field in status table
                $q->whereDate('start_datetime','>=',$yesterday); 
            }])->get();

        return response()->json(['result' => $eventUser], $this->successStatus);
    }


}
