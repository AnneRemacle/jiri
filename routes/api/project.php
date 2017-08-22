<?php

use Illuminate\Http\Request;
use Jiri\Project;


//Projects
Route::get('/projects', function () {
    return \Jiri\Project::all();
});
Route::get('/projects/{project}', function (\Jiri\Project $project) {
    return $project;
});
Route::get('/projects/{project}/implementations', function (\Jiri\Project $project) {
    return $project->implementations;
});
Route::get('/projects/{project}/events', function (\Jiri\Project $project) {
    return $project->events;
});
Route::get('/projects/{project}/weights', function (\Jiri\Project $project) {
    return $project->weights;
});
