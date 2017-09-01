<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Carbon\Carbon;
use Jiri\Meeting;
use Jiri\Score;

class MeetingController extends Controller
{
    public function create( Event $event ){
        return view("meetings.create")->with([
            "event" => $event
        ]);
    }

    public function updateOrStore( Request $request, Event $event ){
        foreach( $request->get("results") as $user_id => $students){
            foreach( $students as $student_id => $times ){
                if( $times["start_time"] != null && $times["end_time"] != null){
                    if( $event->meetings->where("user_id", $user_id)->where("student_id", null)->count() ){
                        $meeting = $event->meetings->where("user_id", $user_id)->where("student_id", null)->first();
                        $meeting->update([
                            "start_time" => Carbon::createFromFormat("H:i", $times["start_time"]),
                            "end_time" => Carbon::createFromFormat("H:i", $times["end_time"])
                        ]);
                    } elseif( $event->meetings->where("user_id", $user_id)->where("student_id", $student_id)->count() ) {
                        $meeting = $event->meetings->where("user_id", $user_id)->where("student_id", $student_id)->first();
                        $meeting->update([
                            "start_time" => Carbon::createFromFormat("H:i", $times["start_time"]),
                            "end_time" => Carbon::createFromFormat("H:i", $times["end_time"])
                        ]);
                    } else {
                        $meeting = Meeting::create([
                            "start_time" => Carbon::createFromFormat("H:i", $times["start_time"]),
                            "end_time" => Carbon::createFromFormat("H:i", $times["end_time"])
                        ]);
                    }

                    $meeting->event()->associate($event);
                    $meeting->user()->associate($user_id);
                    $meeting->student()->associate($student_id);
                    $meeting->save();

                    foreach( $meeting->student->implementations->where("event_id", $event->id) as $implementation ){
                        if( !Score::where("implementation_id", $implementation->id)->where("meeting_id", $meeting->id)->count() ){
                            $score = Score::create();
                            $score->meeting()->associate($meeting->id);
                            $score->implementation()->associate($implementation->id);
                            $score->save();
                        }
                    }
                }
            }
        }

        return redirect()->back();
    }
}
