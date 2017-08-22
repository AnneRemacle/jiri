<?php

use Illuminate\Http\Request;
use Jiri\Meeting;

// Meetings
Route::get('/meetings', function () {
    return \Jiri\Meeting::all();
});
Route::get('/meetings/{meeting}', function (\Jiri\Meeting $meeting) {
    return $meeting;
});
Route::get('/meetings/{meeting}/student', function (\Jiri\Meeting $meeting) {
    return $meeting->student;
});
Route::get('/meetings/{meeting}/user', function (\Jiri\Meeting $meeting) {
    return $meeting->user;
});
Route::get('/meetings/{meeting}/scores', function (\Jiri\Meeting $meeting) {
    return $meeting->scores;
});
Route::get('/meetings/{meeting}/event', function (\Jiri\Meeting $meeting) {
    return $meeting->event;
});
