<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Jiri\Project;
use Jiri\Weight;
use Jiri\Implementation;
use Jiri\Score;

class ProjectController extends Controller
{
    public function create( Event $event, Project $project ) {
        $projects = Project::all();

        return view("projects.create")->with([
            "event" => $event,
            "projects" => $projects
        ]);
    }

    public function addOrStore( Event $event, Request $request ){

        if( Project::where("name", $request->get("name"))->count() ){
            $project = Project::where("name", $request->get("name"))->first();
        }else{
            $project = Project::create([
                "name" => $request->get("name"),
                "description" => $request->get("description")
            ]);
            $project->save();
        }

        $weight = Weight::create([
            "weight" => $request->get("weight")
        ]);

        foreach( $event->students as $student ){
            if( !$event->implementations->where("student_id", $student->id)->where("project_id", $project->id)->count() ){
                $implementation = Implementation::create();
                $implementation->student()->associate($student);
                $implementation->event()->associate($event);
                $implementation->project()->associate($project);
                $implementation->save();
            }

            foreach( $student->meetings as $meeting ){
                foreach( $student->implementations->where("event_id", $event->id)->where("project_id", $project->id) as $implementation ){
                    if( !$implementation->scores->where("meeting_id", $meeting->id)->count() ){
                        $score = Score::create();
                        $score->meeting()->associate($meeting);
                        $score->implementation()->associate($implementation);
                        $score->save();
                    }
                }
            }
        }

        $weight->project()->associate($project);
        $weight->event()->associate($event);
        $weight->save();

        return redirect()->back();
    }

    public function manage( Event $event ){
        return view("projects.manage")->with([
            "event" => $event,
            "projects" => Project::all()
        ]);
    }

    public function update( Event $event, Request $request ) {
        foreach( $request->get("results") as $project_id => $data){
            $project = Project::find($project_id);
            $project->update([
                "name" => $data["name"],
                "description" => $data["description"]
            ]);

            $weight = $project->weights->where("event_id", $event->id)->first();
            $weight->update([
                "weight" => $data["weight"]
            ]);
            $weight->save();

            $project->save();
        }

        return redirect()->back();
    }

}
