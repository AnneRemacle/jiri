<?php
    Route::group(["prefix" => "projects"], function() {
        Route::get('/', [
            "as" => 'projects.index',
            "uses" => 'ProjectController@index'
        ]);

        Route::get('/{project}', [
            "as" => 'projects.show',
            "uses" => 'ProjectController@show'
        ]);

        Route::post('/addOrStore', [
            "as" => "projects.addOrStore",
            "uses" => "ProjectController@addOrStore"
        ]);

        Route::post("/{project}/update", [
            "as" => "projects.update",
            "uses" => "ProjectController@update"
        ]);
    });
