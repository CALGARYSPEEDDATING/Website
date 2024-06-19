<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Backend\EventsUpdateProfile;

class UpdateProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:profile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email users to update profile';

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
        $events = Event::approved()->whereDate('start_datetime', '=', Carbon::now()->addDays(2)->format("Y-m-d"))
            ->get();

        foreach ($events as $event) {
            $users = $event->users()->whereWaitList(0)->orderBy('pivot_created_at', 'desc')->get();

            foreach ($users as $user) {
                if ($user->profile->profile == "") {
                    Mail::to($user->email)->send(new EventsUpdateProfile($user, $event));
                    \Log::info('Profile update email sent ' . \Carbon\Carbon::now());
                }
            }
        }

        \Log::info('Profile update cron ran successfully ' . \Carbon\Carbon::now());
    }
}
