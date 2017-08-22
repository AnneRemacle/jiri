<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
Use Jiri\Event;
Use Jiri\User;
Use Jiri\Student;
Use Route;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where("is_admin", 1)->get();

        return view("events.create")->with([
            "users" => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Event::insert([
            "course_name" => $request->get("course_name"),
            "academic_year" => $request->get("academic_year"),
            "exam_session" => $request->get("exam_session"),
            "user_id" => $request->get("user_id"),
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        return redirect()->route("user.events");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Request $request)
    {
        $apiRequest = Request::create('/api/events/'.$event->id, 'GET');
        $request->replace($apiRequest->input());
        $event = Route::dispatch($apiRequest)->getOriginalContent();

        return view("events.show")->with([
            "event" => $event,
            "users" => User::where("is_admin", 1)->get(),
        ]);
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
    public function update(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->save();

        return redirect()->route("user.events");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route("user.events");
    }

    public function inviteStudent(Event $event){
        return view("events.inviteStudent")->with([
            "students" => Student::all(),
            "event" => $event
        ]);
    }

    public function addOrStoreStudent( Request $request, Event $event ) {
        if( Student::where("email", $request->get("email"))->count() ){
            $student = Student::where("email", $request->get("email"))->first();
      } else {
           $student = Student::insert([
            "email" => $request->get("email"),
            "name" => $request->get("name"),
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
      }
    //   dd(Student::where("email", $request->get("email"))->first());
      if( !$event->students->contains($student) ){
        $event->students()->attach($student);
        $event->save();
      }

      return redirect()->back();
    }

    public function removeStudent( Event $event, Student $student ) {
        $event->students()->detach($student);
        $event->save();

      return redirect()->back();
    }

    public function inviteJury(Event $event){
        return view("events.inviteJury")->with([
            "jurys" => User::all(),
            "event" => $event
        ]);
    }

    public function addOrStoreJury( Request $request, Event $event ) {
        if( User::where("email", $request->get("email"))->count() ){
            $jury = User::where("email", $request->get("email"))->first();
      } else {
           $jury = User::insert([
            "email" => $request->get("email"),
            "name" => $request->get("name"),
            "company" => $request->get("company"),
            "password" => $request->get("password"),
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
      }
    // dd(User::where("email", $request->get("email"))->first());
      if( !$event->users->contains($jury) ){
        $event->users()->attach($jury);
        $event->save();
      }

      return redirect()->back();
    }

    public function removeJury( Event $event, User $jury ) {
        $event->users()->detach($jury);
        $event->save();

      return redirect()->back();
    }
}
