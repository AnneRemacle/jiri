<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Event;
use Image;
use Hash;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $user]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    public function addOrStore(Request $request)
    {
        $event = Event::find($request->get("event_id"));
        $pictureName = "";

        if( User::where("email", $request->get("email"))->count() ){
            $jury = User::where("email", $request->get("email"))->first();
        }else {
            if( $request->file("picture") != null ){
                $uploadedImage = $request->file("picture");
                $pictureName = $uploadedImage->getClientOriginalName();

                $img = Image::make( $uploadedImage );
                $img->fit(200)->save( public_path()."/img/users/".$pictureName );
            }

            $jury = User::create([
                "email" => $request->get("email"),
                "name" => $request->get("name"),
                "photo" => $pictureName,
                "company" => $request->get("company"),
                "clear_password" => $request->get("password"),
                "password" => bcrypt($request->get("password")),
            ]);

            $jury->save();
        }

        $event->users()->attach($jury);

        return response()->json("ok");
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
     public function show(User $user)
     {
         return response()->json($user);
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
     public function update( Request $request, User $user ) {
         $pictureName = null;

         if( $user->photo != null ){
             File::delete( public_path()."/img/users/".$user->picture );
         }

         if( $request->file("picture") != null){
             $uploadedImage = $request->file("picture");
             $pictureName = $uploadedImage->getClientOriginalName();

             $img = Image::make( $uploadedImage );
             $img->fit(200)->save( public_path()."/img/users/".$pictureName );

             $user->update([
                 "photo" => $pictureName
             ]);
         }

         $user->update([
             "email" => $request->get("email"),
             "name" => $request->get("name"),
             "photo" => $pictureName,
             "company" => $request->get("company"),
             "clear_password" => $request->get("password"),
             "password" => bcrypt($request->get("password")),
         ]);

         $user->save();

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

    public function getUserEvents(User $user){
        return response()->json($user->events);
    }
}
