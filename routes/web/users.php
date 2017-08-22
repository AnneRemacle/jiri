<?php
    Auth::routes();

    Route::get('/dashboard', 'DashboardController@main');

    Route::get("user/events", [
        "as" => "user.events",
        "uses" => "UserController@events"
    ]);
