<?php

namespace Jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function main(Request $request)
    {
        $apiRequest = Request::create('/api/events/1/students', 'GET', ['embed' => 'performances']);
        $request->replace($apiRequest->input());
        $event = Route::dispatch($apiRequest)->getOriginalContent();
        $user = Auth::user();

        return view('users/dashboard', compact('event', 'user'));
    }

    public function admin(Request $request) {
        $apiRequest = Request::create('/api/events/1/students', 'GET', ['embed' => 'performances']);
        $request->replace($apiRequest->input());
        $event = Route::dispatch($apiRequest)->getOriginalContent();
        $user = Auth::user();

        return view("admin/dashboard", compact('event', 'user'));
    }
}
