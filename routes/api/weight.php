<?php

use Illuminate\Http\Request;
use Jiri\Weight;

// Weights
Route::get('/weights', function () {
    return \Jiri\Weight::all();
});
Route::get('/weights/{weight}', function (\Jiri\Weight $weight) {
    return $weight;
});
Route::get('/weights/{weight}/event', function (\Jiri\Weight $weight) {
    return $weight->event;
});
Route::get('/weights/{weight}/project', function (\Jiri\Weight $weight) {
    return $weight->project;
});
