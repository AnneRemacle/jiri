<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Jiri\Project;
use Jiri\Weight;

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

    public function update( Project $project ) {
        $project = Project::update([
            "name" => $request->get("name"),
            "description" => $request->get("description")
        ]);

        $project->save();

        return redirect()->back();
    }

}
