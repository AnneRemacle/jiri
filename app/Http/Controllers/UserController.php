<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Route;
use Jiri\Event;
use Jiri\User;
use Hash;
use Jiri\Http\Requests\User\AddOrStore;
use Jiri\Http\Requests\User\Update;


class UserController extends Controller
{

    public function index() {
        return view("users.index")->with([
            "users" => User::all()
        ]);
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
    public function edit( User $user )
    {
        return view("users.edit")->with([
            "user" => $user
        ]);
    }

    public function update( User $user, Update $request ) {
        $user->fill([
            "name" => $request->get('name'),
            "email" => $request->get("email"),
            "company" => $request->get("company"),
        ]);

        if( $request->get("password") != "" ){
            $user->fill([
                "password" => Hash::make($request->get("password")),
                "clear_password" => $request->get("password")
            ]);
        }

        $user->save();

        return redirect()->back();
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

    public function addOrStore( AddOrStore $request, Event $event ) {
        if( User::where("email", $request->get("email"))->count() ){
            $jury = User::where("email", $request->get("email"))->first();
        } else {
           $jury = User::insert([
            "email" => $request->get("email"),
            "name" => $request->get("name"),
            "company" => $request->get("company"),
            "password" => Hash::make($request->get("password")),
            "clear_password" => $request->get("password")
        ]);
      }

      if( !$event->users->contains($jury) ){
        $event->users()->attach($jury);
        $event->save();
      }

      return redirect()->back();
    }

    public function manage( Event $event ){
        return view("users.manage")->with([
            "event" => $event,
            "users" => User::all()
        ]);
    }
}
