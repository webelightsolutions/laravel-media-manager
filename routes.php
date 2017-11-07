<?php
Route::get('media', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@create');
Route::post('media/store', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@store');
