<?php
    Route::group(["prefix" => "projects"], function() {
        Route::get("/create/{event}", [
            "as" => "projects.create",
            "uses" => "ProjectController@create",
            "middleware" => "can:administrate"
        ]);

        Route::post("/store/{event}", [
            "as" => "projects.addOrStore",
            "uses" => "ProjectController@addOrStore",
            "middleware" => "can:administrate"
        ]);

        Route::put("/update/{event}", [
            "as" => "projects.update",
            "uses" => "ProjectController@update",
            "middleware" => "can:administrate"
        ]);

        Route::get("/manage/{event}", [
            "as" => "projects.manage",
            "uses" => "ProjectController@manage",
            "middleware" => "can:administrate"
        ]);

        Route::delete("/{project}/delete", [
            "as" => "projects.delete",
            "uses" => "ProjectController@destroy"
        ]);
    });
