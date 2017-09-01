<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Jiri\Implementation;

class ImplementationController extends Controller
{
    public function update( Request $request, Event $event ){
        foreach($request->get("results") as $student_id => $projects){
            foreach($projects as $project_id => $data){
                $implementation = $event->implementations->where("student_id", $student_id)->where("project_id", $project_id)->first();

                $implementation->update([
                    "url_repo" => $data["url_repo"],
                    "url_project" => $data["url_project"]
                ]);

                $implementation->save();
            }
        }

        return redirect()->back();
    }
}
