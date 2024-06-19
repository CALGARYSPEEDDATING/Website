<?php

namespace App\Http\Controllers\Backend;

use PDF;
use Mail;
use DateTime;
use Purifier;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Auth\User;
use App\Models\EventUser;
use App\Models\UserMatch;
use App\Models\EventDetails;
use Illuminate\Http\Request;
use App\Models\EmailTracking;
use Illuminate\Http\Response;
use Spatie\CalendarLinks\Link;
use App\Models\ExportRegistrant;
use App\Models\EventEmailTemplate;
use App\Mail\Backend\EventsNoLikes;
use App\Http\Controllers\Controller;
use App\Mail\Backend\EventCancelled;
use App\Mail\Backend\EventsNoMatches;
use App\Mail\Backend\EventsSingleMatch;
use Illuminate\Support\Facades\Session;
use App\Mail\Backend\EventsMultipleMatches;

class EventController extends Controller
{
    const PENDING = 0;
    const ENABLED = 1;
    const DISABLED = 2;
    const ADMIN_ONLY = 3;
    const CANCELLED = 4;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function saveUser($id, Request $request)
    {
        // dd($request->all());
        $get_users = User::findMany($request->user_id);
        // dd($get_users);
        foreach ($get_users as $user) {
            // \DB::table('event_user')->where('user_id', '=', Input::get('email'))->exists()

            \DB::table('event_user')->insert([
                'event_id' => $id,
                'user_id' => $user->id,
                'paid' => $request->input('paid_user', 0),
                'gender' => $user->profile->gender,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        return back()->withFlashSuccess('Users Added');
    }
    // ajax
    public function addUsers(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $users = $users = \DB::table('users')->select(
                'id',
                'first_name',
                'last_name',
                'email',
                'phone'
            )->take(5)->get();
        } else {
            $search = $request->input('searchTerm');
            $users = $users = $users = \DB::table('users')->select(
                'id',
                'first_name',
                'last_name',
                'email',
                'phone'
            )->where('first_name', 'LIKE', '%' . $search . '%')->orWhere('last_name', 'LIKE', '%' . $search . '%')->take(30)->get();
        }
        $data = [];
        foreach ($users as $use) {
            $data[] = array(
                "id" => $use->id,
                "text" => $use->first_name . ' ' . $use->last_name . ' (' . $use->email . ') (' . $use->phone . ')'
            );
        }
        return response()->json($data);
    }
    public function checkUser(Request $request)
    {
        $user = User::find($request->user_id);
        $attributes = [
            'checked' => $request->value,
        ];
        $user->events()->updateExistingPivot($request->event_id, $attributes);
        // return response()->json($request->all());
        return response(null, Response::HTTP_OK);
        // return response()->json($request->all());
    }

    public function index()
    {
        $events = Event::upcoming()->notExpired()->get();
        return view('backend.events.index', compact('events'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = \DB::table('tags')->get();
        return view('backend.events.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $full_start =  $request->start_date . ' ' . date("H:i:s", strtotime($request->start_time));
        $full_end =  $request->end_date . ' ' . date("H:i:s", strtotime($request->end_time));
        $eventCounter = Event::count();
        $event = new Event();
        $event->title = $request->title;
        $event->seo_title = $request->seo_title;
        $event->seo_description = $request->seo_description;

        $event->slug = str_slug($event->title, '-');
        $event->slugId = ++$eventCounter;
        $event->address = $request->address;
        $event->start_datetime = $this->changeDateFormat($full_start);
        $event->end_datetime = $this->changeDateFormat($full_end);
        $event->limit = $request->limit; // Male
        $event->f_limit = $request->f_limit; // Female
        $event->type = $request->type;
        $event->price_female = $request->price_female;
        $event->price_male = $request->price_male;
        $event->description = Purifier::clean($request->description);
        $event->main_image = $request->filepath;
        $event->tags = 'Tag';
        $event->city = $request->city;
        $event->postal_code = $request->postal_code;
        $event->region = $request->region;
        $event->street_address = $request->street_address;
        if ($event->save()) {
            $details = new EventDetails();
            $details->event_id = $event->id;
            $details->male_age_to = $request->male_age_to;
            $details->male_age_from = $request->male_age_from;
            $details->female_age_to = $request->female_age_to;
            $details->female_age_from = $request->female_age_from;
            $details->more = isset($request->more) ? $request->more : '';

            $details->save();
            return back()->withFlashSuccess('Works');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $s = date("Y-m-d H:i", strtotime($event->start_datetime));
        $e = date("Y-m-d H:i", strtotime($event->end_datetime));
        $from = DateTime::createFromFormat('Y-m-d H:i', $s);
        $to = DateTime::createFromFormat('Y-m-d H:i', $e);
        $link = Link::create($event->title, $from, $to)
            ->description($event->description)
            ->address($event->address);
        $google_link = $link->google();
        $registrants = $event->users()->whereWaitList(0)->orderBy('pivot_created_at', 'desc')->get();
        $wait_list = $event->users()->whereWaitList(1)->orderBy('pivot_created_at', 'desc')->get();
        $users = User::get();
        $ics_link = $link->ics();
        $difference = $from->diff($to);
        $duration = $this->formatInterval($difference);
        $previous = Event::where('id', '<', $event->id)->max('id');
        $next = Event::where('id', '>', $event->id)->min('id');

        // dd($event);
        return view('backend.events.show', compact(
            'users',
            'event',
            'google_link',
            'ics_link',
            'duration',
            'registrants',
            'wait_list',
            'previous',
            'next'
        ));
    }
    public function destroy(Request $request, $id)
    {
        // return response()->json($request->id);
        Event::findOrFail($request->id)->delete();
        if ($request->ajax()) {
            return response(null, Response::HTTP_OK);
        }
        // Event::findOrFail($request->id)->delete();
        return back()->withFlashSuccess('Event Deleted');
    }

    public function duplicate(Request $request)
    {
        //
        // return response()->json($id);
        $event = Event::findOrFail($request->id);

        $eventCounter = Event::count();

        $copyEvent = $event->replicate();
        $copyEvent->status = 0;
        // return response()->json($event);
        // $copyEvent->push();

        $copyEvent->push();

        foreach ($event->details()->get() as $e) {
            // $details = EventDetails::where('event_id', $event->id)->first();
            $copyDetails = $e->replicate();
            $copyDetails->event_id = $copyEvent->id;
            $copyDetails->push();
        }

        $event_slug_check = Event::whereId($copyEvent->id)->first();

        $event_slug_check->slugId = ++$eventCounter;
        $event_slug_check->save();

        return route('admin.event.show', ['id' => $copyEvent->id]);
        // foreach ($event->details()->get() as $e) {
        //     $details = EventDetails::where('event_id', $event->id)->first();
        //     $copyDetails = $details->replicate();
        //     $copyDetails->event_id = $copyEvent->id;
        //     $copyDetails->push();
        // }


        // $event->relations = [];
        // $event->load('details');
        // $relations = $event->getRelations();
        // foreach ($relations as $relationName => $values) {
        //     $copyEvent->details()->replicate();
        //     return response()->json($copyEvent);
        // }
        // $test =
        // $detail = EventDetails::whereEventId($event->id)->first();
        // foreach ($event->getRelations() as $relation => $items) {
        //     foreach ($items as $item) {
        //         unset($item->id);
        //         $detail->{$relation}()->create($item->toArray());
        //     }
        // }

        // $detail = EventDetails::whereEventId($event->id)->first();
        // $copyDetail = $detail->replicate();
        // $copyDetail->event_id = $copyEvent->id;
        // $copyDetail->save();

        // return response()->json($event_copied->id);



        // return response(null, Response::HTTP_OK);
    }
    public function selectPastEvent(Request $request)
    {
        $event = Event::findOrFail($request->id);
        if($event->selected_past_event == 1)
            $event->selected_past_event = 0;
        else
            $event->selected_past_event = 1;
        $event->save();
        if ($request->ajax()) {
            return response(null, Response::HTTP_OK);
        }
        if($event->selected_past_event == 1)
            return back()->withFlashSuccess('Un-Selected');
        else
            return back()->withFlashSuccess('Selected');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('TEst');
    }


    public function setStatus(Request $request)
    {
        $id = $request->id;

        switch ($request->value) {
            case '0':
                Event::where('id', $id)->update(['status' => self::PENDING]);
                return response(null, Response::HTTP_OK);
            case '1':
                Event::where('id', $id)->update(['status' => self::ENABLED]);
                return response(null, Response::HTTP_OK);
            case '2':
                Event::where('id', $id)->update(['status' => self::DISABLED]);
                return response(null, Response::HTTP_OK);
            case '3':
                Event::where('id', $id)->update(['status' => self::ADMIN_ONLY]);
                return response(null, Response::HTTP_OK);
            case '4':
                $cancelled_event = tap(Event::where('id', $id))->update(['status' => self::CANCELLED])->first();
                foreach ($cancelled_event->users as $user) {
                    Mail::to($user->email)->send(new EventCancelled($user, $cancelled_event));
                    // return response()->json($user->email);
                }
                return response(null, Response::HTTP_OK);
            default:
                return '';
        }
        return '';
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->events()->detach($request->event_id);
        return response()->json($request->all());
    }
    public function addToRegistrants(Request $request)
    {
        $user = User::find($request->id);
        $attributes = [
            'paid' => 1,
            'wait_list' => 0,
        ];
        $user->events()->updateExistingPivot($request->event_id, $attributes);
        // return response()->json($request->all());
        return response(null, Response::HTTP_OK);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $full_start =  $request->edit_start_date . ' ' . date("H:i:s", strtotime($request->edit_start_time));
        $full_end =  $request->edit_end_date . ' ' . date("H:i:s", strtotime($request->edit_end_time));

        $event = Event::find($id);
        $event->title = $request->title;
        $event->seo_title = $request->seo_title;
        $event->seo_description = $request->seo_description;
        $event->slug = str_slug($event->title, '-');
        $event->address = $request->address;
        $event->start_datetime = $this->changeDateFormat($full_start);
        $event->end_datetime = $this->changeDateFormat($full_end);
        $event->limit = $request->limit;
        $event->f_limit = $request->f_limit; // Female
        $event->type = $request->type;
        $event->price_female = $request->price_female;
        $event->price_male = $request->price_male;
        $event->description = Purifier::clean($request->description);
        $event->notes = $request->notes;
        $event->main_image = $request->filepath;
        $event->tags = 'Tag';
        $event->city = $request->city;
        $event->postal_code = $request->postal_code;
        $event->region = $request->region;
        $event->street_address = $request->street_address;
        $event->save();
        $details = EventDetails::where('event_id', $event->id)->first();
        $details->male_age_to = $request->male_age_to;
        $details->male_age_from = $request->male_age_from;
        $details->female_age_to = $request->female_age_to;
        $details->female_age_from = $request->female_age_from;
        $details->more = isset($request->more) ? $request->more : '';

        $details->save();
        return back()->withFlashSuccess('Event Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }


    // Format Time for Calendar
    public function changeDateFormat($date)
    {
        $time = DateTime::createFromFormat('m/d/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    public function formatInterval(\DateInterval $interval)
    {
        $result = "";
        if ($interval->y) {
            $result .= $interval->format("%y year(s) ");
        }
        if ($interval->m) {
            $result .= $interval->format("%m month(s) ");
        }
        if ($interval->d) {
            $result .= $interval->format("%d day(s) ");
        }
        if ($interval->h) {
            $result .= $interval->format("%h hour(s) ");
        }
        if ($interval->i) {
            $result .= $interval->format("%i minute(s) ");
        }
        if ($interval->s) {
            $result .= $interval->format("%s second(s) ");
        }

        return $result;
    }

    public function search(Request $request, Event $event)
    {
        $events_q =  $event->newQuery();
        $query = array();
        if ($request->has('keywords')) {
            $query['keywords'] = $request->input('keywords');
            $events_q->where('title', 'LIKE', '%' . $request->input('keywords') . '%');
        }
        if ($request->has('status')) {
            $query['status'] = $request->input('status');
            $events_q->where('status', '=', $request->input('status'));

            // $jobs->where('status', 'LIKE', '%'.$request->input('type').'%');
        }

        if ($request->has('time_period')) {
            $query['time_period'] = $request->input('time_period');
            $today = Carbon::today()->toDateString();
            if ($request->input('time_period') == 'today') {
                $events_q->where('start_datetime', '=', $today);
            }
            if ($request->input('time_period') == 'past') {
                $events_q->where('start_datetime', '<', $today);
            }
            if ($request->input('time_period') == 'upcoming') {
                $events_q->where('start_datetime', '>', $today);
            }
            // $events_q->where('status', '=', $request->input('status'));

            // $jobs->where('status', 'LIKE', '%'.$request->input('type').'%');
        }

        if ($request->has('date_posted')) {
            $posted_options = explode('|', $request->input('date_posted'));
            $query['date_posted'] = $posted_options[0];
            $events_q->whereDate('created_at', '>=', $posted_options[0]);
        }




        $events = Event::orderBy('id', 'desc')->paginate(200, ['*'], 'results');
        // $results = $events_q->paginate(2)->chunk(100);
        $results = $events_q->paginate(200);
        // dd($events);
        // $results->appends([$request->except('page')]);
        // dd($results);
        $message = 'Sorry, no event matched your criteria.';
        if (count($results) > 0) {
            return view('backend.events.index', compact('results', 'events', 'query'));
        } else {
            // return view('website.jobseekers.search')->withMessage($message)->with($data);
            return view('backend.events.index', compact('message', 'events', 'query'));
        }
    }
    public function pdf($event_id)
    {
        $event = Event::findOrFail($event_id);
        $females = $event->users()->whereWaitList(0)
            ->where('gender', 1)
            ->inRandomOrder()
            ->get();
        $males = $event->users()->whereWaitList(0)
            ->where('gender', 0)
            ->inRandomOrder()
            ->get();
        $pdf = PDF::loadView('backend.events.pdf.registrants', compact('females', 'males'));

        $user_auth_id = auth()->user()->id;
        $existing_user = ExportRegistrant::where('user_id', $user_auth_id)->first();
        if($existing_user){
            $delete_record = ExportRegistrant::where('user_id', $user_auth_id)->delete();
        }
        foreach($females as $females)
        {
            $export_registrants = new ExportRegistrant();
            $export_registrants->first_name = $females->first_name;
            $export_registrants->interest = $females->profile->profile;
            $export_registrants->q1 = $females->profile->question_one;
            $export_registrants->q2 = $females->profile->question_two;
            $export_registrants->q3 = $females->profile->question_three;
            $export_registrants->q4 = $females->profile->question_four;
            $export_registrants->gender = 'female';
            $export_registrants->user_id = $user_auth_id;
            $export_registrants->save();
        }
        foreach($males as $males)
        {
            $export_registrants = new ExportRegistrant();
            $export_registrants->first_name = $males->first_name;
            $export_registrants->interest = $males->profile->profile;
            $export_registrants->q1 = $males->profile->question_one;
            $export_registrants->q2 = $males->profile->question_two;
            $export_registrants->q3 = $males->profile->question_three;
            $export_registrants->q4 = $males->profile->question_four;
            $export_registrants->gender = 'male';
            $export_registrants->user_id = $user_auth_id;
            $export_registrants->save();
        }


        return $pdf->download('list-registrants.pdf');
    }

    public function userInterest($event_id)
    {
        // $event = Event::findOrFail($event_id);
        // $females = $event->users()->whereWaitList(0)
        //     ->where('gender', 1)
        //     ->inRandomOrder()
        //     ->get();
        // $males = $event->users()->whereWaitList(0)
        //     ->where('gender', 0)
        //     ->inRandomOrder()
        //     ->get();

        //Calgary Admin Password = $2y$10$WYjBJBEEz1ycMnHfK6uTuOWpETh.18ipCfVApoCrkdsVIJIORpM2e
        //Edmonton hisam Password = $2y$10$2iYGsFcjp4xp.XqKOioOEuQ.u9mlhdj7x10v9cHug6xMmWMaRPZ1y
        $user_id = auth()->user()->id;
        $records = ExportRegistrant::where('user_id', $user_id)->get();
        $pdf = PDF::loadView('backend.events.pdf.interest', compact('records'));
        // return $pdf->stream();
        return $pdf->download('event_user_interest.pdf');
    }
    public function matches(Request $request)
    {
        $get_matches_all = UserMatch::where('event_id', $request->event_id)->get();
        foreach($get_matches_all as $get_user){
            $get_user->delete();
        }
        if($request->chk_user){
            foreach($request->chk_user as $user_chk){
                $user_id = explode('&', $user_chk);
                $user = User::find($user_id[1]);
                $ids = $user->likesToUsers()->pluck('user_id');
                // $match_count = $user->matches($request->event_id)->count();
                try {
                    $mutual_like = UserMatch::where('liked_user_id', $user_id[1])
                        ->where('user_id', $user_id[0])
                        ->where('event_id', $request->event_id)
                        ->first();
                        $match = new UserMatch();
                        $match->user_id = $user_id[1];
                        $match->liked_user_id = $user_id[0];
                        $match->event_id = $request->event_id;
                        $match->matched = $mutual_like ? 1 : 0;
                        $match->comment = $request->comment;
                        $match->save();

                    if ($mutual_like) {
                        $mutual_like->matched = 1;
                        $mutual_like->save();
                        // $match_user = User::find($mutual_like->user_id);
                        // $matches = $user->matches($request->event_id)->get();
                        // $match_count = $user->matches($request->event_id)->count();

                        // if ($match_count > 1) {
                        //     Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
                        //     Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                        //     // return (new EventsMultipleMatches($user, $matches))->render(); for testing
                        //     // return (new EventsSingleMatch($match_user, $user))->render();
                        // } else {
                        //     Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
                        //     Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                        // }
                    }

                }catch (Exception $e) {}
            }
        }
        if($request->chk_user_f){

            foreach($request->chk_user_f as $user_chk){
                $user_id = explode('&', $user_chk);

                $user = User::find($user_id[1]);
                $ids = $user->likesToUsers()->pluck('user_id');
                // $match_count = $user->matches($request->event_id)->count();
                try {
                    $mutual_like = UserMatch::where('liked_user_id', $user_id[1])
                        ->where('user_id', $user_id[0])
                        ->where('event_id', $request->event_id)
                        ->first();

                        $match = new UserMatch();
                        $match->user_id = $user_id[1];
                        $match->liked_user_id = $user_id[0];
                        $match->event_id = $request->event_id;
                        $match->matched = $mutual_like ? 1 : 0;
                        $match->comment = $request->comment;
                        $match->save();
                    if ($mutual_like) {
                        $mutual_like->matched = 1;
                        $mutual_like->save();
                        // $match_user = User::find($mutual_like->user_id);
                        // $matches = $user->matches($request->event_id)->get();
                        // $match_count = $user->matches($request->event_id)->count();

                        // if ($match_count > 1) {
                        //     Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
                        //     Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                        //     // return (new EventsMultipleMatches($user, $matches))->render(); for testing
                        //     // return (new EventsSingleMatch($match_user, $user))->render();
                        // } else {
                        //     Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
                        //     Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                        // }
                    }
                    // if($unmatch){
                    //     $last_entry = UserMatch::latest()->first();
                    //     $last_entry->matched = 1;
                    //     $last_entry->save();
                    // }
                }catch (Exception $e) {}
            }
        }
        // $user_id = array();

        Session::put('db_session','db save');
        return back()->withFlashSuccess('Match Created');
        // $user = User::find($request->user_id);
        // $ids = $user->likesToUsers()->pluck('user_id');
        // // $match_count = $user->matches($request->event_id)->count();
        // try {
        //     foreach ($request->liked_user_id as $liked_id) {
        //         $mutual_like = UserMatch::where('liked_user_id', $request->user_id)
        //             ->where('user_id', $liked_id)
        //             ->where('event_id', $request->event_id)
        //             ->first();
        //         $match = new UserMatch();
        //         $match->user_id = $request->user_id;
        //         $match->liked_user_id = $liked_id;
        //         $match->event_id = $request->event_id;
        //         $match->matched = $mutual_like ? 1 : 0;
        //         $match->comment = $request->comment;
        //         $match->save();
        //         if ($mutual_like) {
        //             $mutual_like->matched = 1;
        //             $mutual_like->save();
        //             $match_user = User::find($mutual_like->user_id);
        //             $matches = $user->matches($request->event_id)->get();
        //             $match_count = $user->matches($request->event_id)->count();

        //             if ($match_count > 1) {
        //                 // Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
        //                 // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
        //                 // return (new EventsMultipleMatches($user, $matches))->render(); for testing
        //                 // return (new EventsSingleMatch($match_user, $user))->render();
        //             } else {
        //                 // Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
        //                 // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
        //             }
        //         }
        //     }
        //     return back()->withFlashSuccess('Match Created');
        // } catch (Exception $e) {
        // }
    }

    public function completeMatches($id)
    {
        $emailMultipleMatches = EventEmailTemplate::whereId(1)->first();
        $emailNoLikes = EventEmailTemplate::whereId(2)->first();
        $emailNoMatches = EventEmailTemplate::whereId(3)->first();
        $emailSingleMatch = EventEmailTemplate::whereId(4)->first();

        $event = Event::findOrFail($id);
        $time_now = Carbon::now()->addHour();

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

                $multiple_matches = UserMatch::where('user_id', $user->id)->where('event_id', $event->id)->first();
                if ($match_count > 1) {
                    if($multiple_matches->multiple_mail_check == 1){
                        Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches,$emailMultipleMatches));
                        $multiple_matches->multiple_mail_check = 2;
                        $multiple_matches->save();
                    }
                    // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user, $emailSingleMatch));
                    $event->auto_mail_check = 1;
                    $event->matches_submitted = 1;
                    $event->matches_submitted_time = strtotime($time_now);
                    $event->save();

                    $email_tracking = EmailTracking::where('user_id', $user->id)->where('event_id', $event->id)->first();
                    if(!$email_tracking){
                        $email_tracking = new EmailTracking();
                        $email_tracking->user_id = $user->id;
                        $email_tracking->event_id = $event->id;
                        $email_tracking->status = 1;
                        $email_tracking->save();
                    }
                } else {
                    Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user, $emailSingleMatch));
                    Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user, $emailSingleMatch));
                    $event->auto_mail_check = 1;
                    $event->matches_submitted = 1;
                    $event->matches_submitted_time = strtotime($time_now);
                    $event->save();

                    $email_tracking = EmailTracking::where('user_id', $user->id)->where('event_id', $event->id)->first();
                    if(!$email_tracking){
                        $email_tracking = new EmailTracking();
                        $email_tracking->user_id = $user->id;
                        $email_tracking->event_id = $event->id;
                        $email_tracking->status = 1;
                        $email_tracking->save();
                    }
                }
            }
        }
        $users = $event->users()->whereWaitList(0)->orderBy('pivot_created_at', 'desc')->get();
        foreach ($users as $user) {
            $likes = $user->likesToUsers()->where('event_id', $event->id)->count();
            $matches = $user->matches($event->id)->count();
            if (!$matches) {
                if ($likes>0) {
                    Mail::to($user->email)->send(new EventsNoMatches($user, $likes,$emailNoMatches));
                    $event->auto_mail_check = 1;
                    $event->matches_submitted = 1;
                    $event->matches_submitted_time = strtotime($time_now);
                    $event->save();

                    $email_tracking = EmailTracking::where('user_id', $user->id)->where('event_id', $event->id)->first();
                    if(!$email_tracking){
                        $email_tracking = new EmailTracking();
                        $email_tracking->user_id = $user->id;
                        $email_tracking->event_id = $event->id;
                        $email_tracking->status = 1;
                        $email_tracking->save();
                    }
                }
                if($likes==0){
                    Mail::to($user->email)->send(new EventsNoLikes($user,$emailNoLikes));
                    $event->auto_mail_check = 1;
                    $event->matches_submitted = 1;
                    $event->matches_submitted_time = strtotime($time_now);
                    $event->save();


                    $email_tracking = EmailTracking::where('user_id', $user->id)->where('event_id', $event->id)->first();
                    if(!$email_tracking){
                        $email_tracking = new EmailTracking();
                        $email_tracking->user_id = $user->id;
                        $email_tracking->event_id = $event->id;
                        $email_tracking->status = 1;
                        $email_tracking->save();
                    }
                }
                \Log::info('No matches email sent ' . \Carbon\Carbon::now());
            }
        }
        \Log::info('No matches email sent by admin successfully ' . \Carbon\Carbon::now());
        Session::put('matches_session','matches save');
        return back()->with('flash_message_match_result','Match Results Sent');
    }

    public function get_user_within_rang(Request $request)
    {
        $age_range = explode(';', $request->age_range);
        $users = \DB::table('users')->join('dating_profiles', 'dating_profiles.user_id', 'users.id')
            ->whereBetween(\DB::raw('TIMESTAMPDIFF(YEAR,users.dob,CURDATE())'), array($age_range[0], $age_range[1]))
            ->where('gender', $request->gender)
            ->get();
        return response()->json($users);
    }

    public function profileMatches(Request $request)
    {
        $get_match_user = UserMatch::where('user_id', auth()->user()->id)
                ->where('event_id', $request->event_id)
                ->get();
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
        if($request->chk_user){
            foreach($request->chk_user as $user_chk){
                $user_id = explode('&', $user_chk);
                            $user = User::find($user_id[1]);
                            $ids = $user->likesToUsers()->pluck('user_id');
                            // $match_count = $user->matches($request->event_id)->count();
                            try {
                                $mutual_like = UserMatch::where('liked_user_id', $user_id[1])
                                    ->where('user_id', $user_id[0])
                                    ->where('event_id', $request->event_id)
                                    ->first();
                                    $match = new UserMatch();
                                    $match->user_id = $user_id[1];
                                    $match->liked_user_id = $user_id[0];
                                    $match->event_id = $request->event_id;
                                    $match->matched = $mutual_like ? 1 : 0;
                                    $match->comment = $request->comment;
                                    $match->save();

                                if ($mutual_like) {
                                    $mutual_like->matched = 1;
                                    $mutual_like->save();
                                    $match_user = User::find($mutual_like->user_id);
                                    $matches = $user->matches($request->event_id)->get();
                                    $match_count = $user->matches($request->event_id)->count();

                                    if ($match_count > 1) {
                                        // Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
                                        // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                                        // return (new EventsMultipleMatches($user, $matches))->render(); for testing
                                        // return (new EventsSingleMatch($match_user, $user))->render();
                                    } else {
                                        // Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
                                        // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                                    }
                                }

                            }catch (Exception $e) {}

            }
        }
        if($request->chk_user_f){

            foreach($request->chk_user_f as $user_chk){
                $user_id = explode('&', $user_chk);
                    $user = User::find($user_id[1]);
                    $ids = $user->likesToUsers()->pluck('user_id');
                    // $match_count = $user->matches($request->event_id)->count();
                    try {
                        $mutual_like = UserMatch::where('liked_user_id', $user_id[1])
                            ->where('user_id', $user_id[0])
                            ->where('event_id', $request->event_id)
                            ->first();

                            $match = new UserMatch();
                            $match->user_id = $user_id[1];
                            $match->liked_user_id = $user_id[0];
                            $match->event_id = $request->event_id;
                            $match->matched = $mutual_like ? 1 : 0;
                            $match->comment = $request->comment;
                            $match->save();
                        if ($mutual_like) {
                            $mutual_like->matched = 1;
                            $mutual_like->save();
                            $match_user = User::find($mutual_like->user_id);
                            $matches = $user->matches($request->event_id)->get();
                            $match_count = $user->matches($request->event_id)->count();

                            if ($match_count > 1) {
                                // Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
                                // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                                // return (new EventsMultipleMatches($user, $matches))->render(); for testing
                                // return (new EventsSingleMatch($match_user, $user))->render();
                            } else {
                                // Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
                                // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
                            }
                        }
                        // if($unmatch){
                        //     $last_entry = UserMatch::latest()->first();
                        //     $last_entry->matched = 1;
                        //     $last_entry->save();
                        // }
                    }catch (Exception $e) {}
            }

        }
        // $user_id = array();

        return back()->withFlashSuccess('Match Created');
        // $user = User::find($request->user_id);
        // $ids = $user->likesToUsers()->pluck('user_id');
        // // $match_count = $user->matches($request->event_id)->count();
        // try {
        //     foreach ($request->liked_user_id as $liked_id) {
        //         $mutual_like = UserMatch::where('liked_user_id', $request->user_id)
        //             ->where('user_id', $liked_id)
        //             ->where('event_id', $request->event_id)
        //             ->first();
        //         $match = new UserMatch();
        //         $match->user_id = $request->user_id;
        //         $match->liked_user_id = $liked_id;
        //         $match->event_id = $request->event_id;
        //         $match->matched = $mutual_like ? 1 : 0;
        //         $match->comment = $request->comment;
        //         $match->save();
        //         if ($mutual_like) {
        //             $mutual_like->matched = 1;
        //             $mutual_like->save();
        //             $match_user = User::find($mutual_like->user_id);
        //             $matches = $user->matches($request->event_id)->get();
        //             $match_count = $user->matches($request->event_id)->count();

        //             if ($match_count > 1) {
        //                 // Mail::to($user->email)->send(new EventsMultipleMatches($user, $matches));
        //                 // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
        //                 // return (new EventsMultipleMatches($user, $matches))->render(); for testing
        //                 // return (new EventsSingleMatch($match_user, $user))->render();
        //             } else {
        //                 // Mail::to($user->email)->send(new EventsSingleMatch($user, $match_user));
        //                 // Mail::to($match_user->email)->send(new EventsSingleMatch($match_user, $user));
        //             }
        //         }
        //     }
        //     return back()->withFlashSuccess('Match Created');
        // } catch (Exception $e) {
        // }
    }

    public function emailTracking($id)
    {
        $email_trackings = EmailTracking::where('event_id', $id)->with('user')->get();
        return view('backend.events.emailTracking', compact('email_trackings'));
    }
}
