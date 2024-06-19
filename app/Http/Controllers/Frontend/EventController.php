<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use Alert;
use Session;
use DateTime;
use App\Models\Event;
use App\Models\UserTotalCredit;
use Stripe\Error\Card;
use App\Models\Payment;
use App\Models\UserMatch;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Spatie\CalendarLinks\Link;
use App\Http\Controllers\Controller;
use App\Mail\Frontend\UserRegisterEmail;
use App\Mail\Frontend\UserRegisterCreditAdminEmail;

use Spatie\CalendarLinks\Generators\Yahoo;
use App\Mail\Frontend\UserRegisterAdminEmail;
use App\Http\Requests\Frontend\Event\UserCheckoutRequest;
use App\Http\Requests\Frontend\Event\UserRegisterRequest;

class EventController extends Controller
{
    const MALE = 0;
    const FEMALE = 1;


    // public function index()
    // {
    //     // $events = Event::take(5)->notExpired()->approved()->orderBy('created_at', 'DESC')->get();
    //     $events = Event::take(5)->notExpired()->approved()->upcoming()->paginate(5);
    //     return view('frontend.website.events.index', compact('events'));
    //     //->upcoming()
    // }

    public function old_index(Request $request)
    {
        return redirect()->route('frontend.events.index');
    }
    public function index(Request $request)
    {
        // $events = Event::take(5)->notExpired()->approved()->orderBy('created_at', 'DESC')->get();
        $events = Event::notExpired()->approved()->upcoming()->paginate(10);
        return view('frontend.website.events.index', compact('events'));
        //->upcoming()
    }

    public function loadEvents(Request $request)
    {
        $events = new Event;
        if ($request->has('page')) {
            $events = Event::notExpired()->approved()->upcoming()->paginate(10);
        }
        $eventsHTML = view('frontend.website.events.events_more', compact('events'))->render();
        return response()->json(['html' => $eventsHTML, 'page' => $events->currentPage(), 'hasMorePages' => $events->hasMorePages()]);
    }

    public function loadEventsOne(Request $request)
    {
        $output = '';
        $id = $request->id;

        // $events = Event::where('id', '<', $id)->notExpired()->approved()->orderBy('created_at', 'DESC')->take(5)->get();
        $events = Event::take(5)->notExpired()->approved()->upcoming()->paginate(5);
        // return response()->json($events);





        if (!$events->isEmpty()) {
            foreach ($events as $event) {
                $url = route('frontend.event.show', [$event->id, $event->slug]);
                $image = $event->main_image;
                $status = $event->users()->whereGender(0)->count() == $event->limit && $event->users()->whereGender(1)->count() == $event->f_limit ? 'FUll' : '';
                $women = $event->users()->whereGender(1)->count() >= $event->f_limit ? 'Full' : 'Places Available';
                $men = $event->users()->whereGender(0)->count() >= $event->limit ? 'Full' : 'Places Available';
                $output .= '  <div class="row">
                <div class="col-12 ">
                    <div class="event_container mb-5 ">
                        <div class="event_image">
                            <a href=""><img src="' . $event->main_image . '" alt="Event image"></a>

                        </div>
                        <div class="event_description shadow">
                            <div class="row pb-3 pt-4">
                                <div class="col-lg-2 col-sm-2">
                                    <h2 class="event_date pl-5 mb-0 font-weight-bold">' . date("j", strtotime($event->start_datetime)) . '</h2>
                                    <h6 class="event_month pl-5 mb-0">' . date("M", strtotime($event->start_datetime)) . '</h6>
                                    <h6 class="event_day pl-5">' . date("D", strtotime($event->start_datetime)) . '</h6>

                                </div>
                                <div class="col-lg-7 col-sm-10 event_detail_description">
                                    <a href="">
                                        <h3 class="event_title "><i class="far fa-clock text_primary mr-2"></i> ' . $event->title . ', #' . $event->id . '
                                            (We have a 2yr leeway on the low and high end of the ages) Loaded</h3>
                                    </a>

                                    <div class="row mt-3">
                                        <div class="col-sm-8">
                                            <p class="mb-2 d-flex"><span class="text_primary mr-3"><strong>Where:</strong></span>
                                                <a target="_blank" href="http://maps.google.com/?q=' . $event->address . '">' . $event->address . '</a>
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="mb-2"><span class="text_primary"><strong>Time:
                                                    </strong></span> ' . date("g:i a", strtotime($event->start_datetime)) . '</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-sm-8">

                                            <p><span class="text_primary mr-1"><strong>Women: </strong></span>
                                                ' . $women . '
                                                </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p><span class="text_primary"><strong>Men: </strong></span>
                                                ' . $men . '
                                                </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center">
                                <a href="' . $url . '" class="btn btn-theme btn-lg">Register</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>';
            }
            // $output .= '<div id="remove-row">
            //                 <button id="btn-more" data-id="'.$event->id.'" class="btn btn-theme btn-lg" > Load More </button>
            //             </div>';
            $output .= '<div id="remove-row">
                            <button id="btn-more" data-url="' . $events->nextPageUrl() . '" class="btn btn-theme btn-lg" > Load More </button>
                        </div>';

            echo $output;
        }
    }





    public function show($id, $slug = '')
    {
        Session::forget('waitlist');
        $event = Event::findOrFail($id);
        $s = date("Y-m-d H:i", strtotime($event->start_datetime));
        $e = date("Y-m-d H:i", strtotime($event->end_datetime));
        $from = DateTime::createFromFormat('Y-m-d H:i', $s);
        $to = DateTime::createFromFormat('Y-m-d H:i', $e);
        $link = Link::create($event->title, $from, $to)
            ->description($event->description)
            ->address($event->address);
        $google_link = $link->google();
        $ics_link = $link->ics();
        $men_count = $event->users()->whereGender(0)->count();
        $women_count = $event->users()->whereGender(1)->count();

        // $event_men = $event->users()->whereGender();
        // dd($event_men);


        if ($slug !== $event->slug) {
            return redirect()->to($event->url);
        }
        return view('frontend.website.events.show', compact('event', 'google_link', 'ics_link', 'men_count', 'women_count'));
    }

    public function waitList(UserRegisterRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $request->session()->put('gender', $request->registration_gender);
        $request->session()->put('waitlist', 1);
        $dob = $request->user()->dob;
        $userAge = date("Y") - date("Y", strtotime($dob));
        $user_gender = $request->user()->profile->gender;
        $men_age_check = $userAge <= $event->details->male_age_from - 2  || $userAge >= $event->details->male_age_to + 2;
        $women_age_check = $userAge <= $event->details->female_age_from - 2 || $userAge >= $event->details->female_age_to + 2;
        $selected_gender = $request->session()->get('gender');
        foreach ($event->users as $users) {
            if ($event->users->contains($request->user()->id) && $users->pivot->wait_list == 1) {
                return back()->withFlashDanger('You have already been added to the wait list.');
            }
        }
        if ($user_gender == self::MALE && $men_age_check) {
            return back()->withFlashDanger('You don\'t meet the required age group for this event.');
        }
        if ($user_gender == self::FEMALE && $women_age_check) {
            return back()->withFlashDanger('You don\'t meet the required age group for this event.');
        }

        if ($user_gender != $selected_gender) {
            return back()->withFlashDanger('Please select the gender that matches your profile.');
        }


        return redirect()->route('frontend.events.waiver.index', [$id, $event->slug]);
    }

    public function register(UserRegisterRequest $request, $id)
    {
        // dd('ss');

        $event = Event::findOrFail($id);
        $request->session()->put('gender', $request->registration_gender);
        $dob = $request->user()->dob;
        $userAge = date("Y") - date("Y", strtotime($dob));

        $user_gender = $request->user()->profile->gender;
        $men_age_check = $userAge <= $event->details->male_age_from - 2 || $userAge >= $event->details->male_age_to + 2;
        $women_age_check = $userAge <= $event->details->female_age_from - 2 || $userAge >= $event->details->female_age_to + 2;
        $selected_gender = (int) $request->session()->get('gender');



        if ($user_gender == self::MALE && $men_age_check) {
            // dd(Alert::success('test'));
            // Alert::success('Event Created!')->persistent("Close");
            // Alert::message('Message', 'Optional Title');
            // return back();
            return back()->withFlashDanger('You don\'t meet the required age group for this event.');
        }
        if ($user_gender == self::FEMALE && $women_age_check) {
            return back()->withFlashDanger('You don\'t meet the required age group for this event.');
        }

        if ($user_gender != $selected_gender) {
            // Alert::message('Message', 'Optional Title');
            // Alert::success('Event Created!')->persistent("Close");
            // Alert::error('Error Message', 'Please select the gender that matches your profile');
            // Alert::error('Error Message', 'Please select the gender that matches your profile');
            return back()->withFlashDanger('Please select the gender that matches your profile.');
        }




        return redirect()->route('frontend.events.waiver.index', [$id, $event->slug]);
    }


    public function waiver($id)
    {
        $event = Event::findOrFail($id);

        if ($event) {
            return view('frontend.website.waiver');
        }
    }

    public function waiverPost(Request $request, $id)
    {
        // $request->session()->forget('waitlist');
        $event = Event::findOrFail($id);
        $waitList = $request->session()->get('waitlist');
        // $selected_gender = (int) $request->session()->get('gender');
        // foreach ($request->user()->profile as $profile) {
        //     $user_gender = $profile->gender;
        // }

        if ($event) {
            if ($waitList) {
                $request->user()->events()->attach(
                    $event->id,
                    [
                        'paid' => 0,
                        'wait_list' => 1,
                        'waiver' => 1,
                    ]
                );
                $request->session()->forget('waitlist');
                return redirect()->route('frontend.index')->withFlashSuccess('You will be notified if a spot becomes available.');
            }
            return redirect()->route('frontend.events.checkout', [$id, $event->slug]);
        }
    }

    public function checkout($id)
    {
        $event = Event::findOrFail($id);
        return view('frontend.website.events.checkout', compact('event'));
    }
    public function checkoutPost(UserCheckoutRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $stripe = Stripe::make(env('STRIPE_SECRET'));

        // Check if user already registered

        // Check if user registered and haven't paid
        foreach ($event->users as $users) {
            // if ($event->users->contains($request->user()->id) && $users->pivot->paid == 0) {
            //     dd('true');
            // } else {
            //     dd('false');
            // }
            if ($event->users->contains($request->user()->id) && $users->pivot->paid == 1) {
                return redirect()->route('frontend.events.index')->withFlashDanger('You have already register and paid for this event.');
            }
        }


        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->get('card_number'),
                    'exp_month' => $request->get('card_expiry_date'),
                    'exp_year'  => $request->get('card_expiry_year'),
                    'cvc'       => $request->get('card_cvc'),
                    'name'      => $request->get('card_holder')
                ],
            ]);

            if (!isset($token['id'])) {
                return redirect()->back()->withFlashDanger('There are errors with your credit card');
            }

            // Charge Card
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'CAD',
                'amount'   => $request->input('amount'),
                'receipt_email' => $request->user()->email,
            ]);
            if ($charge['status'] == 'succeeded') {
                // dd($charge);



                $request->user()->events()->attach(
                    $event->id,
                    [
                        'paid' => 1,
                        'wait_list' => 0,
                        'waiver' => 1,
                        'gender' => $request->user()->profile->gender,
                    ]
                );
                $payment = new Payment();
                $payment->event_id = $event->id;
                $payment->user_id = $request->user()->id;
                $payment->stripe_id = $charge['id'];
                $payment->balance_transaction = $charge['balance_transaction'];
                $payment->amount = $charge['amount'] / 100;
                $payment->last_four = $charge['source']['last4'];
                $payment->save();

                // number_format()
                // $request->user()->email
                // Send Emails
                Mail::to('info@calgaryspeeddating.com')->send(new UserRegisterAdminEmail($request->user(), $event, $payment));
                Mail::to($request->user()->email)->send(new UserRegisterEmail($request->user(), $event));

                // return (new UserRegisterEmail($request->user(), $event))->render();
                // $event_total = Customer::orderBy('id', 'desc')->where('team_id', $customer->team_id)->get();
                // \DB::table('totals')
                // ->where('event_id', $customer->event_id)
                // ->update(['total_donations' => $event_total->sum('amount')]);
                // \DB::table('team_totals')
                // ->where('team_id', $customer->team_id)
                // ->update(['total_donations' => $event_total->sum('amount')]);
                // }
                // return (new UserRegisterEmail($request->user, $event))->render();
                Session::put('payment','payment successful');
                return redirect()->route('frontend.events.thanksPage');
            } else {
                return redirect()->back()->withFlashDanger('Not good');
            }
            /**
             * Start to Catch Errors
             */
        } catch (Exception $e) {
            return redirect()->back()->withFlashDanger($e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return redirect()->back()->withFlashDanger($e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return redirect()->back()->withFlashDanger($e->getMessage());
        }
    }
	
    public function checkoutCreditPost(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        foreach ($event->users as $users) {
            if ($event->users->contains($request->user()->id) && $users->pivot->paid == 1) {
                return redirect()->route('frontend.events.index')->withFlashDanger('You have already register and paid for this event.');
            }
        }
        $credit_first = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
        $credit_first->count=$credit_first->count-1;
        $credit_first->save();
        if($credit_first){
            $request->user()->events()->attach(
                $event->id,
                [
                    'paid' => 1,
                    'wait_list' => 0,
                    'waiver' => 1,
                    'gender' => $request->user()->profile->gender,
                ]
            );
                $payment = new Payment();
                $payment->event_id = $event->id;
                $payment->user_id = $request->user()->id;
                $payment->amount =$event->price_male;
                $payment->save();
                Mail::to('info@calgaryspeeddating.com')->send(new UserRegisterCreditAdminEmail($request->user(), $event, $payment));
                Mail::to($request->user()->email)->send(new UserRegisterEmail($request->user(), $event));
                Session::put('payment','payment successful');
                return redirect()->route('frontend.events.thanksPage');
         }
        else {
            return redirect()->back()->withFlashDanger('Not good');
        }
    }
	
    public function showmatch(Request $request)
    {
        $matches = UserMatch::where('event_id', $request->id)->where('user_id', auth()->user()->id)->where('matched', 1)->with('users')->get();
        //  \Auth::user()->matches($request->id)->get();
        return response()->json($matches);
    }

    public function thanksPage(Request $request)
    {
        if(Session::has('payment'))
        {
            Session::forget('payment');
            return view('frontend.website.events.thanks');
        }
        else{
            return redirect()->route('frontend.events.index');
        }

    }

    public function pastEvents()
    {
        $events = Event::where('selected_past_event', '1')->paginate(1);
        return view('frontend.website.events.past_events', compact('events'));
    }

    public function pastEventDetailShow($id, $slug = '')
    {
        Session::forget('waitlist');
        $event = Event::findOrFail($id);
        $s = date("Y-m-d H:i", strtotime($event->start_datetime));
        $e = date("Y-m-d H:i", strtotime($event->end_datetime));
        $from = DateTime::createFromFormat('Y-m-d H:i', $s);
        $to = DateTime::createFromFormat('Y-m-d H:i', $e);
        $link = Link::create($event->title, $from, $to)
            ->description($event->description)
            ->address($event->address);
        $google_link = $link->google();
        $ics_link = $link->ics();
        $men_count = $event->users()->whereGender(0)->count();
        $women_count = $event->users()->whereGender(1)->count();

        if ($slug !== $event->slug) {
            return redirect()->to($event->url);
        }
        return view('frontend.website.events.past_event_detail_show', compact('event', 'google_link', 'ics_link', 'men_count', 'women_count'));
    }
}
