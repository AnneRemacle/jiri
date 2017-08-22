<?php

use Illuminate\Http\Request;
use Jiri\Event;


//Events
Route::get('/events', function () {
    return \Jiri\Event::all();
});
Route::get('/events/{event}', function (\Jiri\Event $event) {
    return $event;
});
Route::get('/events/{event}/projects', function (Request $request, \Jiri\Event $event) {
    // Let's try something fun and useful…
    // Let's return an event + its students and their performance for the event

    if ($request->has('embed')) {
        if ($request->input('embed') === 'weights') {
            return $event->with([
                'projects.weights' => function ($query) use ($event) {
                    $query->where('event_id', '=', $event->id);
                }
            ])->find($event->id);
        }
    } else {
        return $event->projects;
    }
});
Route::get('/events/{event}/meetings', function (\Jiri\Event $event) {
    return $event->meetings;
});
Route::get('/events/{event}/implementations', function (\Jiri\Event $event) {
    return $event->implementations;
});
Route::get('/events/{event}/weights', function (\Jiri\Event $event) {
    return $event->weights;
});
Route::get('/events/{event}/performances', function (\Jiri\Event $event) {
    return $event->performances;
});
Route::get('/events/{event}/students', function (Request $request, \Jiri\Event $event) {
    // Let's try something fun and useful…
    // Let's return an event + its students and their performance for the event

    if ($request->has('embed')) {
        if ($request->input('embed') === 'performances') {
            return $event->with([
                'students.performances' => function ($query) use ($event) {
                    $query->where('event_id', '=', $event->id);
                }
            ])->find($event->id);
        }
    } else {
        return $event->students;
    }
});
Route::get('/events/{event}/users', function (\Jiri\Event $event) {
    return $event->users;
});
Route::get('/events/{event}/owner', function (\Jiri\Event $event) {
    return $event->owner;
});
