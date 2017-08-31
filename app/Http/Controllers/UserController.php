<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Route;
use Jiri\Event;
use Jiri\User;

class UserController extends Controller
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

    public function events(Request $request){
        $apiRequest = Request::create('/api/users/'.Auth::user()->id.'/events', 'GET');
        $request->replace($apiRequest->input());
        $events = Route::dispatch($apiRequest)->getOriginalContent();

        return view("users.events")->with([
            "events" => $events,
            "user" => Auth::user()
        ]);
    }

    public function addOrStore( Request $request, Event $event ) {
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

    public function manage( Event $event ){
        return view("users.manage")->with([
            "event" => $event,
        ]);
    }
}
