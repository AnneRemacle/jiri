<?php

use Illuminate\Http\Request;
use Jiri\Performance;


// Performances
Route::get('/performances', function () {
    return \Jiri\Performance::all();
});
Route::get('/performances/{performance}/student', function (\Jiri\Performance $performance) {
    return $performance->student;
});
Route::get('/performances/{performance}/event', function (\Jiri\Performance $performance) {
    return $performance->event;
});
