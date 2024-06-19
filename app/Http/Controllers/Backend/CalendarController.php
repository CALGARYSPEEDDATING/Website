<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use DB;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];
        // $event_list = Event::orderBy('id', 'desc')->paginate(10);
        $event_list = Event::orderBy('created_at', 'desc')->paginate(10);
        $event = DB::table('events')->select(
            'id',
            'title',
            'slug',
            'start_datetime',
            'end_datetime',
            'address',
            'description',
            'status'
        )
                 ->get();
        
        foreach ($event as $e) {
            $events[] = \Calendar::event(
                $e->title,
                false,
                $e->start_datetime,
                $e->end_datetime,
                $e->id,
                [
                // 'page_url' => url('admin/event/' . $e->slug),
                'url' => route('admin.event.show', $e->id),
                'color' => 'blue',
                'tooltip' => '<div class="tooltip_title"></div>',
                'textColor' => 'white',
                'contentHeight' => 'auto',
                'description' => $e->description,
                'address' => $e->address,
                'date' => date("F j, Y", strtotime($e->start_datetime)),
                'time' => date("g:i a", strtotime($e->start_datetime)).' - '.date("g:i a", strtotime($e->end_datetime)),
                ]
            );
        }

        
        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'firstDay' => 1,
                'contentHeight' => '500',
            ]);
        // ->setCallbacks([
        //     'eventClick' => 'function(event, jsEvent, view) {
        //         $("#modalTitle").html(event.title);
        //         $("#address").html(event.address);
        //         $("#description").html(event.description);
        //         $("#time").html(event.time);
        //         $("#date").html(event.date);
        //         $("#fullCalModal").modal();
        //         $("#eventUrl").attr("href", event.page_url);
                    
        //     }',
        //   ]);
              
        return view('backend.events.calendar', compact('calendar', 'event_list'));
    }
}
