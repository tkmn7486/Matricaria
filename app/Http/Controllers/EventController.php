<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getAllEvents (Request $request)
    {
        $events = Event::all();
        dd($events);
    }

    public function getEventById (Request $request, $id)
    {
        $event = Event::find($id);
        dd($event);
    }

    public function createEvent (Request $request)
    {
        DB::beginTransaction();
        try {
            $event = new Event();
            $event->event_name = $request->event_name;
            $event->is_official = $request->is_official;
            $event->deadline = $request->deadline;
            $event->event_start = $request->event_start;
            $event->event_end = $request->event_end;
            $event->event_place_name = $request->event_place_name;
            $event->event_place_address = $request->event_place_address;
            $event->owner = $request->owner;
            $event->event_description = $request->event_description;
            $event->attendees = $request->attendees;
            $event->memo = $request->memo;
            $event->save();
            DB::commit();
            dd($event);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
