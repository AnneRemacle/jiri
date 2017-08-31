<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Jiri\Implementation;

class ImplementationController extends Controller
{
    public function updateOrStore( Request $request, Event $event ){
        foreach($request->get("results") as $student_id => $projects){
            foreach($projects as $project_id => $data){
                if( $event->implementations->where("student_id", $student_id)->where("project_id", $project_id)->count() ){
                    $implementation = $event->implementations->where("student_id", $student_id)->where("project_id", $project_id)->first();

                    $implementation->update([
                        "url_repo" => $data["url_repo"],
                        "url_project" => $data["url_project"]
                    ]);

                    $implementation->save();
                } else {
                    $implementation = Implementation::create([
                        "url_repo" => $data["url_repo"],
                        "url_project" => $data["url_project"]
                    ]);

                    $implementation->project()->associate($project_id);
                    $implementation->student()->associate($student_id);
                    $implementation->event()->associate($event);
                    $implementation->save();
                }
            }
        }

        return redirect()->back();
    }
}
