<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Performance;

class PerformanceController extends Controller
{
    public function update( Performance $performance, Request $request ) {
        $performance->fill([
            "manual_score" => $request->get("manual_score")
        ]);

        $performance->save();

        return redirect()->back();
    }
}
