<?php

use Illuminate\Http\Request;
use Jiri\Student;

// Students
Route::get('/students', function () {
    return \Jiri\Student::all();
});
Route::get('/students/{student}', function (\Jiri\Student $student) {
    return $student;
});
Route::get('/students/{student}/meetings', function (\Jiri\Student $student) {
    return $student->meetings;
});
Route::get('/students/{student}/performances', function (\Jiri\Student $student) {
    return $student->performances;
});
Route::get('/students/{student}/users', function (\Jiri\Student $student) {
    return $student->users;
});
