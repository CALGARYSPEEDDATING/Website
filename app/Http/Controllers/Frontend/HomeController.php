<?php

namespace App\Http\Controllers\Frontend;

use App\DynamicPages;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function old_index()
    {
        return redirect()->route('frontend.index');
    }
    public function index()
    {
        // $events = Event::notExpired()->approved()->upcoming()->take(10);
        $events = Event::notExpired()->approved()->upcoming()->paginate(10);
        return view('frontend.index', compact('events'));
    }

    public function test()
    {
        echo "imhere";
    }

    public function loadHomeEvents(Request $request)
    {
        // return response()->json($request->all());
        $events = new Event;
        if ($request->has('page')) {
            $events = Event::notExpired()->approved()->upcoming()->paginate(5);
        }
        $eventsHTML = view('frontend.website.events.events_home_more', compact('events'))->render();
        return response()->json(['html'=>$eventsHTML,'page'=>$events->currentPage(),'hasMorePages'=>$events->hasMorePages()]);
    }

    public function addOnPages()
    {
        $dynamicPages = DynamicPages::orderBy('id','desc')->where('status', '0')->paginate(20);
        return view('frontend.website.dynamic-user-pages', compact('dynamicPages'));
    }
}
