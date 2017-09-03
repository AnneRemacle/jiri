<?php
    Auth::routes();

    Route::get('/dashboard', 'DashboardController@main');

    Route::group(["prefix" => "users"], function() {
        Route::get("/manage/{event}", [
            "as" => "users.manage",
            "uses" => "UserController@manage",
            "middleware" => "can:administrate",
        ]);

        Route::get("/events", [
            "as" => "users.events",
            "uses" => "UserController@events",
            "middleware" => "can:administrate",
        ]);

        Route::post("/addOrStore/{event}", [
            "as" => "users.addOrStore",
            "uses" => "UserController@addOrStore",
            "middleware" => "can:administrate",
        ]);

        Route::get("/index", [
            "as" => "users.index",
            "uses" => "UserController@index",
            "middleware" => "can:administrate",
        ]);

        Route::put("/update/{user}",[
            "as" => "users.update",
            "uses" => "UserController@update",
            "middleware" => "can:administrate"
        ]);

        Route::get("/edit/{user}", [
            "as" => "users.edit",
            "uses" => "UserController@edit",
            "middleware" => "can:administrate"
        ]);
    });
