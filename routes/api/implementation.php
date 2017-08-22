<?php

use Illuminate\Http\Request;
use Jiri\Implementation;

// Implementations
Route::get('/implementations', function () {
    return \Jiri\Implementation::all();
});
Route::get('/implementations/{implementation}', function (\Jiri\Implementation $implementation) {
    return $implementation;
});
Route::get('/implementations/{implementation}/project', function (\Jiri\Implementation $implementation) {
    return $implementation->project;
});
Route::get('/implementations/{implementation}/student', function (\Jiri\Implementation $implementation) {
    return $implementation->student;
});
Route::get('/implementations/{implementation}/scores', function (\Jiri\Implementation $implementation) {
    return $implementation->scores;
});
Route::get('/implementations/{implementation}/event', function (\Jiri\Implementation $implementation) {
    return $implementation->event;
});
