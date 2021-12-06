<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // Get current date of calendar
        $date = Carbon::now();
        if($request->has('month')) {
            $date = Carbon::create($request->month . '-' . $request->year);
        }

        // Add or subtract months if next and prev buttons are clicked
        if($request->next == "true") $date = $date->addMonth();
        if($request->prev == "true") $date = $date->subMonth();

        // Format to string
        $month = strtolower($date->format('M'));
        $year  = strtolower($date->format('Y'));

        // Get date period - first and last date of month
        $datePeriod = CarbonPeriod::create(
                $date->startOfMonth()->format('Y-m-d'),
                $date->endOfMonth()->format('Y-m-d')
            )->toArray();

        // Get all dates & respective english day
        $dates = [];
        foreach($datePeriod as $date) {
            $dateInt = (int) $date->format('d');
            $dates[$dateInt] = [
                'date' => $date->format('Y-m-d'),
                'day'  => $date->shortEnglishDayOfWeek,
            ];
        }

        // Store month and year in session
        // so when fetching events, our controller could keep track
        // of what month should be queried
        session(
            [
                'month' => $month,
                'year'  => $year
            ]
        );

        // Return calendar details
        return response()->json(
            [
                'month' => $month,
                'dates' => $dates,
                'year'  => $year,
            ]
        );
    }
}
