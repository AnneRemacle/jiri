<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Event;
use App\Implementation;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Project::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Project $project)
     {
         $project->fill($request->only("name","description"));
         $project->save();

         return response()->json("ok");
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addOrStore(Request $request){
        $event = Event::find($request->get("event_id"));

        if( Project::where("name", $request->get("name"))->count() ){
            $project = Project::where("name", $request->get("name"))->first();
        }else{
            $project = Project::create([
                "name" => $request->get("name"),
                "description" => $request->get("description")
            ]);
            $project->save();
        }

        $event->projects()->attach($project);

        foreach( $event->students as $student ){
            if( !$event->implementations->where("student_id", $student->id)->where("project_id", $project->id)->count() ){
                $implementation = Implementation::create();
                $implementation->student()->associate($student);
                $implementation->event()->associate($event);
                $implementation->project()->associate($project);
                $implementation->save();
            }
        }

        return response()->json("ok");
    }
}
