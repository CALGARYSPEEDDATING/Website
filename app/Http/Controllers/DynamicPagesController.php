<?php

namespace App\Http\Controllers;

use Session;
use DateTime;
use Carbon\Carbon;
use App\DynamicPages;
use App\Models\Event;
use App\Models\Credit;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Models\DatingProfile;
use App\Models\UserTotalCredit;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\Frontend\Auth\RegisterController;

class DynamicPagesController extends Controller
{
    public function index()
    {
        $dynamicPages = DynamicPages::orderBy('id','desc')->where('status', '0')->paginate(20);
        return view('backend.dynamic_pages.index', compact('dynamicPages'));
    }

    public function create()
    {
        return view('backend.dynamic_pages.create');
    }

    public function store(Request $request)
    {
        $dynamicPages = new DynamicPages();
        $dynamicPages->page_title = $request->page_title;
        $dynamicPages->description = $request->description;
        $dynamicPages->page_slug = str_slug($request->page_title);
        $dynamicPages->status = 0;
        $dynamicPages->save();
        return redirect()->back()->withFlashSuccess('Successfully Added');
    }

    public function show($slug, Request $request)
    {
        $dynamicPages = DynamicPages::where('page_slug', $slug)->first();
        if($dynamicPages->page_slug == 'contact'){
            return view('frontend.website.contact');
        }
        if($dynamicPages->page_slug == 'events'){
            return redirect()->route('frontend.events.index');
        }
        if($dynamicPages->page_slug == 'singles-events-in-calgary'){
            $events = Event::notExpired()->approved()->upcoming()->paginate(10);
            return view('frontend.website.events.index', compact('events'));
        }
        if($dynamicPages->page_slug == 'thanks'){
            if(Session::has('payment'))
            {
                Session::forget('payment');
                return view('frontend.website.events.thanks');
            }
            else{
                return redirect()->route('frontend.events.index');
            }
        }
        if($dynamicPages->page_slug == 'speed-dating-calgary'){
            $events = Event::where('selected_past_event', '1')->paginate(10);
            return view('frontend.website.events.past_events', compact('events'));
        }
        if($dynamicPages->page_slug == 'venue'){
            return view('frontend.website.venue.index');
        }
        if($dynamicPages->page_slug == 'invoices'){
            $payments = $request->user()->payments;

            return view('frontend.user.invoices', compact('payments'));
        }
        if($dynamicPages->page_slug == 'credit'){
            $credits = Credit::where('user_id', auth()->user()->id)->with('events')->get();
            // $credit_count = Credit::where('user_id', auth()->user()->id)->count();
            $credit_first = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
            if($credit_first)
                $credit_count = $credit_first->count;
            else
                $credit_count = 0;

            $friends = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', '!=', 0)->with('users')->get();
            $credit_friend = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', '!=', 0)->first();
            if($credit_friend)
                $credit_count_friend = $credit_friend->count;
            else
                $credit_count_friend = 0;
            return view('frontend.user.creditShow', compact('credits', 'credit_count', 'friends', 'credit_count_friend'));

            return view('frontend.user.invoices', compact('payments'));
        }
        if($dynamicPages->page_slug == 'send-credit'){
            $credit = UserTotalCredit::where('user_id', auth()->user()->id)->where('from_user_id', 0)->first();
            if(!$credit)
                $credit_count = 0;
            else
                $credit_count = $credit->count;
            return view('frontend.user.sendCreditToFriend', compact('credit_count'));
        }
        if($dynamicPages->page_slug == 'send-credit-post'){
            $chk_user = User::where('email', $request->email)->first();
            if(!$chk_user){
                return back()->withFlashDanger('Email not found!');
            }
            else{
                $total_credit_cancel_new = UserTotalCredit::where('user_id',auth()->user()->id)->where('from_user_id', 0)->first();
                $total_credit_cancel_new->count= $total_credit_cancel_new->count - $request->credit;
                $total_credit_cancel_new->save();
                $total_credit_get_new = UserTotalCredit::where('user_id',$chk_user->id )->where('from_user_id', 0)->first();
                if($total_credit_get_new){
                    $total_credit_get_new->count = $total_credit_get_new->count + $request->credit;
                    $total_credit_get_new->save();
                }
                else{
                    $total_credit_get_new = new UserTotalCredit();
                    $total_credit_get_new->user_id = $chk_user->id;
                    $total_credit_get_new->count = $request->credit;
                    $total_credit_get_new->save();
                }
                $total_credit_get_from = UserTotalCredit::where('user_id', $chk_user->id)->where('from_user_id', auth()->user()->id)->first();

                if($total_credit_get_from){
                    $total_credit_get_from->user_id = $chk_user->id;
                    $total_credit_get_from->from_user_id = auth()->user()->id;
                    $total_credit_get_from->count = $total_credit_get_from->count + $request->credit;
                    $total_credit_get_from->save();
                }
                else{
                    $total_credit_get_from_new=new UserTotalCredit();
                    $total_credit_get_from_new->user_id = $chk_user->id;
                    $total_credit_get_from_new->from_user_id = auth()->user()->id;
                    $total_credit_get_from_new->count = $request->credit;
                    $total_credit_get_from_new->save();
                }
                return back()->withFlashSuccess('Credit Sent!');
            }
        }
        if($dynamicPages->page_slug == 'faq'){
            return view('frontend.website.faq');
        }
        if($dynamicPages->page_slug == 'about'){
            return view('frontend.website.about');
        }
        if($dynamicPages->page_slug == 'testimonials'){
            return view('frontend.website.testimonials');
        }
        if($dynamicPages->page_slug == 'policies'){
            return view('frontend.website.policies');
        }
        if($dynamicPages->page_slug == 'how-it-works'){
            return view('frontend.website.how');
        }
        if($dynamicPages->page_slug == 'dashboard'){
            $events = Event::get();
            $get_today_event;
            $valid = '';
            $end = '';
            $logged_user = '';
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
        if($dynamicPages->page_slug == 'account'){
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
        if($dynamicPages->page_slug == 'myevents'){
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
        if($dynamicPages->page_slug == 'hour-check'){
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
        if($dynamicPages->page_slug == 'cancel-event'){
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
        if($dynamicPages->page_slug == 'register'){
            abort_unless(config('access.registration'), 404);
            return view('frontend.auth.register')
                ->withSocialiteLinks((new Socialite)->getSocialLinks());
        }
        if($dynamicPages->page_slug == 'login'){
            return view('frontend.auth.login')
            ->withSocialiteLinks((new Socialite)->getSocialLinks());
        }
        if($dynamicPages){
            return view('frontend.website.dynamicPages', compact('dynamicPages'));
        }
        else{
            abort(404);
        }
    }

    public function edit($id)
    {
        $dynamicPage = DynamicPages::whereId($id)->first();
        return view('backend.dynamic_pages.edit', compact('dynamicPage'));
    }

    public function update(Request $request)
    {
        $dynamicPage = DynamicPages::whereId($request->id)->first();
        $dynamicPage->page_title = $request->page_title;
        $dynamicPage->description = $request->description;
        $dynamicPage->page_slug = str_slug($request->page_title);
        $dynamicPage->save();
        return redirect()->back()->withFlashSuccess('Successfully Updated');

    }

    public function destroy($id)
    {
        DynamicPages::findOrFail($id)->delete();

        return back()->withFlashSuccess('Dynamic Page Deleted');
    }
}
