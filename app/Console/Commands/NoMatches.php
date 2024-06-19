<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Console\Command;
use App\Mail\Backend\EventsNoLikes;
use Illuminate\Support\Facades\Mail;
use App\Mail\Backend\EventsNoMatches;

class NoMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:no_matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email users with not matches';

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
        // $events = Event::approved()->whereDate('end_datetime', '=', Carbon::now()->subDays(3)->format("Y-m-d"))
        //     ->get();
        // foreach ($events as $event) {
        //     $users = $event->users()->whereWaitList(0)->orderBy('pivot_created_at', 'desc')->get();

        //     foreach ($users as $user) {
        //         $likes = $user->likesFromUsers()->where('event_id', $event->id)->count();
        //         $matches = $user->matches($event->id)->count();
        //         if (!$matches) {
        //             if ($likes) {
        //                 Mail::to($user->email)->send(new EventsNoMatches($user, $likes));
        //             } else {
        //                 Mail::to($user->email)->send(new EventsNoLikes($user));
        //             }
        //             \Log::info('No matches email sent ' . \Carbon\Carbon::now());
        //         }
        //     }
        // }
        // $this->info('No matches email sent');
        // \Log::info('No matches cron ran successfully ' . \Carbon\Carbon::now());
    }
}
