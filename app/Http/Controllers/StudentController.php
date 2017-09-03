<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Jiri\Performance;
use Jiri\Student;
use Jiri\Implementation;

use Jiri\Http\Requests\Student\AddOrStore;
use Jiri\Http\Requests\Student\Update;

class StudentController extends Controller
{
    public function index() {
        return view("students.index")->with([
            "students" => Student::all()
        ]);
    }

    public function show( Student $student ){
        return view("students.show")->with([
            "student" => $student
        ]);
    }

    public function update( Student $student, Update $request ) {
        $student->fill([
            "name" => $request->get('name'),
            "email" => $request->get("email")
        ]);

        $student->save();

        return redirect()->back();
    }

    public function delete( Student $student ){
        $student->delete();

        return redirect()->back();
    }

    public function create( Event $event ){
        return view("students.create")->with([
            "event" => $event
        ]);
    }

    public function addOrStore( AddOrStore $request, Event $event ) {
        if( Student::where("email", $request->get("email"))->count() ){
            $student = Student::where("email", $request->get("email"))->first();
      } else {
           $student = Student::create([
            "email" => $request->get("email"),
            "name" => $request->get("name"),
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
        $student->save();
      }

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

      return redirect()->back();
    }

    public function manage( Event $event ){
        return view("students.manage")->with([
            "event" => $event,
            "performances" => $event->performances,
            "students" => Student::all()
        ]);
    }

    public function edit( Student $student ){
        return view("students.edit")->with([
            "student" => $student
        ]);
    }
}
