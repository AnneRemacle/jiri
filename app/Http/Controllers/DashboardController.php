<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Support\Facades\Auth;
use Jiri\Event;

class DashboardController extends Controller
{
    public function main(Request $request)
    {
        $events = Event::whereHas("meetings", function($query) {
            $query->where("user_id", Auth::user()->id);
        })->orderBy("created_at", "DESC")->get();

        return view('users/dashboard')->with([
            "user" => Auth::user(),
            "events" => $events
        ]);
    }

    public function admin(Request $request) {
        $apiRequest = Request::create('/api/events/1/students', 'GET', ['embed' => 'performances']);
        $request->replace($apiRequest->input());
        $event = Route::dispatch($apiRequest)->getOriginalContent();
        $user = Auth::user();

        return view("admin/dashboard", compact('event', 'user'));
    }
}
