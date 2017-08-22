<?php

use Illuminate\Http\Request;
use Jiri\Score;

// Scores
Route::get('/scores', function () {
    return \Jiri\Score::all();
});
Route::get('/scores/{score}', function (\Jiri\Score $score) {
    return $score;
});
Route::get('/scores/{score}/implementation', function (\Jiri\Score $score) {
    return $score->implementation;
});
Route::get('/scores/{score}/meeting', function (\Jiri\Score $score) {
    return $score->meeting;
});
