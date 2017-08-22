<?php

use Illuminate\Http\Request;
use Jiri\User;

// Users
Route::get('/users', function () {
    return \Jiri\User::all();
});
Route::get('/users/{user}', function (\Jiri\User $user) {
    return $user;
});
Route::get('/users/{user}/meetings', function (\Jiri\User $user) {
    return $user->meetings;
});
Route::get('/users/{user}/students', function (\Jiri\User $user) {
    return $user->students;
});
Route::get('/users/{user}/events', function (\Jiri\User $user) {
    return $user->events;
});
