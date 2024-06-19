<?php

namespace App\Console\Commands;

use Carbon\Carbon;

use App\Models\Event;
use App\Models\Auth\User;
use App\Models\EventUser;
use App\Models\UserMatch;
use Illuminate\Console\Command;
use App\Models\EventEmailTemplate;
use App\Mail\Backend\EmailAfterHour;
use Illuminate\Support\Facades\Mail;

class AfterHour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:afterHour';

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
        $event = Event::where('matches_submitted', 1)->where('matches_submitted_auto_mail', 0)->first();
        $emailAfterHour = EventEmailTemplate::whereId(6)->first();
        // foreach ($events as $event) {
            if($event->matches_submitted_time <= Carbon::now()){
                $event_users = EventUser::where('event_id', $event->id)->get();
                $event->matches_submitted_auto_mail = 1;
                $event->save();
                foreach($event_users as $event_user){
                    $user = User::find($event_user->user_id);
                    Mail::to($user->email)->send(new EmailAfterHour($user, $emailAfterHour));
                }
            }            
        // }
        return 0;
    }
}
