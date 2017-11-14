<?php
Route::get('media', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@create');
Route::post('media/store', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@store');
Route::post('media/new-folder', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@makeDirectory');
