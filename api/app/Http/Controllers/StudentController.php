<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\Event;

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
}
