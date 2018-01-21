<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("events.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create([
            "course_name" => $request->get("name"),
            "academic_year" => $request->get("academic_year"),
            "exam_session" => $request->get("session")
        ]);

        $event->user()->associate($request->get("user_id"));
        $event->save();

        return response()->json("ok");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event);
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
        $event->fill($request->only("academic_year","exam_session","course_name"));
        $event->save();

        return response()->json("ok");
    }

    public function delete(Event $event)
    {
        $event->delete();

        return response()->json("ok");
    }
}
