<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface Event {

    function getAllEvents();
    function getEvent();
    function getEvents($month);
    function setEvent(Model $event);
    function schedule(Request $request);
    function getEventDates($event);
}