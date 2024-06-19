<?php

namespace App\Console\Commands;

use Carbon\Carbon;

use App\Models\Event;
use App\Models\Auth\User;
use App\Models\UserMatch;
use Illuminate\Console\Command;
use App\Mail\Backend\EventsNoLikes;
use Illuminate\Support\Facades\Mail;
use App\Mail\Backend\EventsNoMatches;
use App\Mail\Backend\EventsSingleMatch;
use App\Mail\Backend\EventsMultipleMatches;

class Automails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
        if($end < Carbon::now()){
            if($get_today_event){
				if($get_today_event->auto_mail_check == 0){
					$mail_counter = 0;
					$event_users = UserMatch::where('event_id', $get_today_event->id)->get();
					foreach($event_users as $event_user){
						$user = User::find($event_user->user_id);
						$ids = $user->likesToUsers()->pluck('user_id');
						$mutual_like = UserMatch::where('liked_user_id', $event_user->user_id)
										->where('user_id', $event_user->liked_user_id)
										->where('event_id', $get_today_event->id)
										->first();
						if ($mutual_like) {
							$match_user = User::find($mutual_like->user_id);
							$matches = $user->matches($get_today_event->id)->get();
							$match_count = $user->matches($get_today_event->id)->count();
			
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
					$users = $get_today_event->users()->whereWaitList(0)->orderBy('pivot_created_at', 'desc')->get();
					foreach ($users as $user) {
						$likes = $user->likesFromUsers()->where('event_id', $get_today_event->id)->count();
						$matches = $user->matches($get_today_event->id)->count();
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
						$get_today_event->auto_mail_check = 1;
						$get_today_event->save();
						// return response()->json(['result' => 'Email Sent'], $this->successStatus);
					}
					// else  
						// return response()->json(['result' => 'Email not sent'], $this->successStatus);    
				}
			}			
        }
        
        return 0;
    }
}
