<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCalendarEvent;
use App\Models\CalendarEvent;

use App\Contracts\Event;
use Carbon\Carbon;

class CalendarEventController extends Controller
{
    /**
     * 
     */
    public function __construct(Event $event) {
        $this->event = $event;
        
        $month       = session('month') ?? date('Y-m');
        $this->month = Carbon::create($month)->month;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = $this->event->getEvents($this->month);    
        $dates  = $this->event->getEventsDates($events);

        return response()->json(
            [
                'events' => $dates
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreCalendarEvent  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarEvent $request)
    {
        $this->event->schedule($request);

        $events = $this->event->getEvents($this->month);    
        $dates  = $this->event->getEventsDates($events);

        return response()->json(
            [
                'events' => $dates
            ]
        );
    }
}
