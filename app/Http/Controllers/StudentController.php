<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Jiri\Event;
use Jiri\Performance;
use Jiri\Student;

class StudentController extends Controller
{
    public function show( Student $student ){
        return view("students.show")->with([
            "student" => $student
        ]);
    }

    public function delete( Student $student ){
        $student->delete();

        if ( Auth::user()->is_admin) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }

    public function create( Event $event ){
        return view("students.create")->with([
            "event" => $event
        ]);
    }

    public function addOrStore( Request $request, Event $event ) {
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

      return redirect()->back();
    }

    public function manage( Event $event ){
        return view("students.manage")->with([
            "event" => $event,
            "performances" => $event->performances,
            "students" => Student::all()
        ]);
    }
}
