<?php

namespace App\Classes\Calendar\Events;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Contracts\Event;
use App\Models\CalendarEvent;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class WeeklyEvent implements Event {

    private $event;
    private $month;
    private $daysOfWeek = [
        'Monday'    => Carbon::MONDAY, 
        'Tuesday'   => Carbon::TUESDAY, 
        'Wednesday' => Carbon::WEDNESDAY, 
        'Thursday'  => Carbon::THURSDAY, 
        'Friday'    => Carbon::FRIDAY, 
        'Saturday'  => Carbon::SATURDAY, 
        'Sunday'    => Carbon::SUNDAY
    ];

    /**
     * 
     */
    public function __construct(CalendarEvent $event = null) {
        $this->event = $event;
    }

    /**
     * Return event
     * 
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     * Return all events
     * 
     */
    public function getAllEvents() {
        return CalendarEvent::all();
    }

    /**
     * Return events by month
     * 
     */
    public function getEvents($month = null) {
        return CalendarEvent::whereMonth('from', $month)
                ->get();
    }

    /**
     * Set event
     * 
     */
    public function setEvent($event) {
        $this->event = $event;

        return $this;
    }

    /**
     * Store an event
     * 
     */
    public function schedule(Request $request) {
        // Update if event title, from and to dates exists
        // Or create events
        $validated = $request->validated();
        unset($validated['_token']);

        $this->event = $this->event->updateOrCreate(
            // If there could be more than 1 event per date period
            // $request->except([
            //     'recurring_values', '_token'
            // ]),

            // If only one event per date period is allowed
            $request->except([
                'title', 'recurring_values'
            ]),
            $validated
        );

        return $this;
    }

    /**
     * Get event dates
     * 
     */
    public function getEventDates($event = null) {
        if($event == null) return [];

        $dates           = [];
        $datePeriod      = CarbonPeriod::create($event->from, $event->to)->toArray();
        $recurringDays   = $this->getDaysOfWeekInt($event->recurring_values);

        foreach($datePeriod as $date) {
            if(in_array($date->dayOfWeek, $recurringDays)) {
                $dates[$date->format('Y-m-d')][] = $event->title;
            }
        }

        return $dates;
    }

    /**
     * Get all event dates
     * 
     */
    public function getEventsDates($events = null) {
        $events   = $events ?? [];
        if(empty($events)) return [];

        $allDates = $this->getEventDates($events->first());
        foreach($events as $i => $event) {
            if($i == 0) continue;

            $eventDates = $this->getEventDates($event);
            foreach($eventDates as $date => $titles) {
                $allDates[$date] = array_merge(
                    $titles, 
                    $allDates[$date] ?? []);
            }
        }

        return $allDates;
    }

    /**
     * Return days 
     * 
     */
    private function getDaysOfWeekInt($days = []) {
        $recurringDays = [];
        foreach($days as $recurringValue) {
            $recurringDays[] = $this->daysOfWeek[$recurringValue];
        }

        return $recurringDays;
    }
}