<?php
    Route::get('/admin/dashboard', [
        "uses" => "DashboardController@admin",
        'middleware' => 'auth'
    ]);

    Route::get('/admin/createEvent', [
        'as' => 'admin.createEvent',
        'uses' => 'AdminController@createEvent',
        'middleware' => 'can:administrate'
    ]);
