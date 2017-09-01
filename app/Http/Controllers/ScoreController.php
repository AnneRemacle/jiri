<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Score;

class ScoreController extends Controller
{
    public function update( Score $score, Request $request ) {
        $score->update([
            "score" => $request->get("score"),
            "comment" => $request->get("comment")
        ]);
        $score->save();

        $student = $score->meeting->student;
        $event = $score->meeting->event;
        $performance = $student->performances->where("event_id", $event->id)->first();
        $performance->update([
            "calculated_score" => $student->weighted_calculated_final( $event )
        ]);
        $performance->save();

        return redirect()->back();
    }
}
