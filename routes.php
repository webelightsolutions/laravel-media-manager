<?php
Route::get('media/create', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@create');
Route::post('media/store', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@store');
Route::post('media/new-folder', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@makeDirectory');
Route::delete('media/{id}', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@destroy');
Route::get('media', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@getAllMedia');
Route::post('media/{media-name}', 'Webelightdev\LaravelMediaManager\src\Controllers\MediaController@getMediaById');
