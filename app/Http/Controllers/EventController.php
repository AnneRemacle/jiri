<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
Use Jiri\Event;
Use Jiri\User;
Use Jiri\Student;
use Jiri\Meeting;
use Jiri\Project;
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

        return redirect()->route("users.events");
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

        return redirect()->route("users.events");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        foreach( $event->implementations as $implementation ) {
            $implementation->delete();
        }

        foreach( $event->meetings as $meeting ) {
            $meeting->delete();
        }

        foreach( $event->performances as $performance ) {
            $performance->delete();
        }

        $event->delete();

        return redirect()->route("users.events");
    }

    public function inviteStudent(Event $event){
        return view("events.inviteStudent")->with([
            "students" => Student::all(),
            "event" => $event
        ]);
    }

    public function removeStudent( Event $event, Student $student ) {
        foreach( $student->implementations->where("event_id", $event->id) as $implementation){
            foreach( $implementation->scores as $score ){
                $score->delete();
            }
            $implementation->delete();
        }

        foreach( $student->meetings->where("event_id", $event->id)  as $meeting ){
            $meeting->delete();
        }

        $student->performances->where("event_id", $event->id)->first()->delete();
        $event->save();

        return redirect()->back();
    }

    public function inviteJury(Event $event){
        return view("events.inviteJury")->with([
            "jurys" => User::all(),
            "event" => $event
        ]);
    }

    public function removeJury( Event $event, $user_id ) {
        $user = User::find($user_id);

        foreach( $event->meetings->where("user_id", $user->id) as $meeting ){
            foreach( $meeting->scores as $score ){
                $score->delete();
            }
            $meeting->delete();
        }
        $event->users()->detach($user);
        $event->save();

        return redirect()->back();
    }

    public function showStudent( Event $event, Student $student, Meeting $meeting ){
        return view("events.showStudent")->with([
            "event" => $event,
            "student" => $student,
            "meeting" => $meeting
        ]);
    }

    public function meetingShow( Event $event, Meeting $meeting ) {
        return view("events.meetingShow")->with([
            "event" => $event,
            "meeting" => $meeting
        ]);
    }

    public function removeProject( Event $event, Project $project ) {
        $event->projects()->detach($project);

        foreach( $event->implementations->where("project_id", $project->id) as $implementation ){
            $implementation->delete();
        }

        $event->save();

      return redirect()->back();
    }
}
