<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Carbon\Carbon;
use Jiri\Meeting;

class MeetingController extends Controller
{
    public function create( Event $event ){
        return view("meetings.create")->with([
            "event" => $event
        ]);
    }

    public function store( Request $request, Event $event ){
        $results = $request->get("results");

        foreach($results as $jury => $students){
            foreach($students as $student => $times){
                echo $jury."-".$student."-".$times["from"]."-".$times["to"];

                $meeting = Meeting::create([
                    "start_time" => Carbon::createFromFormat("H:i", $times["from"]),
                    "end_time" => Carbon::createFromFormat("H:i", $times["to"])
                ]);

                dd($meeting);

                $meeting->student()->associate($student);
                $meeting->jury()->associate($jury);
                $meeting->event()->associate($event);
            }
        }
    }
}
