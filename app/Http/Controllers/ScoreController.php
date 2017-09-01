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

        return redirect()->back();
    }
}
