<?php
    Route::group(["prefix" => "students"], function() {
        Route::get("/create/{event}", [
            "as" => "students.create",
            "uses" => "StudentController@create",
            "middleware" => "can:administrate"
        ]);

        Route::delete("/delete/{student}", [
            "as" => "students.delete",
            "uses" => "StudentController@delete",
            "middleware" => "can:administrate"
        ]);

        Route::post("/store/{event}", [
            "as" => "students.addOrStore",
            "uses" => "StudentController@addOrStore",
            "middleware" => "can:administrate"
        ]);

        Route::get("/manage/{event}", [
            "as" => "students.manage",
            "uses" => "StudentController@manage",
            "middleware" => "can:administrate"
        ]);

        Route::get("/show/{student}", [
            "as" => "students.show",
            "uses" => "StudentController@show",
        ]);

        Route::put("/update/{student}",[
            "as" => "students.update",
            "uses" => "StudentController@update",
            "middleware" => "can:administrate"
        ]);

        Route::get("/index", [
            "as" => "students.index",
            "uses" => "StudentController@index",
            "middleware" => "can:administrate"
        ]);

        Route::get("/edit/{student}", [
            "as" => "students.edit",
            "uses" => "StudentController@edit",
            "middleware" => "can:administrate"
        ]);
    });
