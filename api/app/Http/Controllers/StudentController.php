<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\Event;
use App\Implementation;
use App\Performance;
use App\Meeting;

use Image;
use File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
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
    public function addOrStore(Request $request)
    {
        $event = Event::find($request->get("event_id"));
        $pictureName = "";

        if( Student::where("email", $request->get("email"))->count() ){
            $student = Student::where("email", $request->get("email"))->first();
        }else {
            if( $request->get("picture") != null ){
                $uploadedImage = $request->file("picture");
                $pictureName = $uploadedImage->getClientOriginalName();

                $img = Image::make( $uploadedImage );
                $img->fit(200)->save( public_path()."/img/students/".$pictureName );
            }

            $student = Student::create([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "photo" => $pictureName
            ]);

            $student->save();
        }

        $event->students()->attach($student);

        $performance = Performance::create();
        $performance->student()->associate($student);
        $performance->event()->associate($event);
        $performance->save();

        foreach( $event->projects as $project ){
            if( !$event->implementations->where("student_id", $student->id)->where("project", $project->id)->count() ){
                $implementation = Implementation::create();
                $implementation->student()->associate($student);
                $implementation->event()->associate($event);
                $implementation->project()->associate($project);
                $implementation->save();
            }
        }

        return response()->json("ok");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Student $student)
     {
         return response()->json($student);
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
     public function update( Request $request, Student $student ) {

         if( $student->photo != null ){
             File::delete( public_path()."/img/students/".$student->picture );
         }

         if( $request->get("picture") != null){
             $uploadedImage = $request->file("picture");
             $pictureName = $uploadedImage->getClientOriginalName();

             $img = Image::make( $uploadedImage );
             $img->fit(200)->save( public_path()."/img/students/".$pictureName );

             $student->update([
                 "photo" => $pictureName
             ]);
         }

         $student->update([
             "name" => $request->get("name"),
             "email" => $request->get("email")
         ]);


         $student->save();

         return response()->json(["msg" => "ok"]);
     }

     public function getImplentationsForEvent(Student $student, Event $event){
         return response()->json($student->implementations->where("event_id", $event->id));
     }

     public function updateImplementations(Request $request, Student $student, Event $event){
         foreach(json_decode($request->get("data")) as $id => $project){
             $implementation = $student->implementations->where("event_id", $event->id)->where("project_id", $id)->first();

             $implementation->update([
                 "url_repo" => $project->githubUrl,
                 "url_project" => $project->siteUrl,
                 "weight" => floatval($project->weight)
             ]);

             $implementation->save();
         }

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

    public function getImplementations(Student $student, Event $event, Meeting $meeting){
        return response()->json($student->implementations()->where("event_id", $event->id)
                                        ->with([
                                            "project",
                                            "scores" => function ($q) use ($meeting){
                                                $q->where("meeting_id", $meeting->id);
                                            }
                                        ])->get());
    }
}
