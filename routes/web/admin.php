<?php
    Route::get('/admin/dashboard', 'DashboardController@admin');

    Route::get('/admin/createEvent', [
        'as' => 'admin.createEvent',
        'uses' => 'AdminController@createEvent'
    ]);
