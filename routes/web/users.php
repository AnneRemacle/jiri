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
    });
