<?php
Route::get('media/create', 'Webelightdev\LaravelMediaManager\Controllers\MediaController@create');
Route::post('media/store', 'Webelightdev\LaravelMediaManager\Controllers\MediaController@store');
Route::post('media/new-folder', 'Webelightdev\LaravelMediaManager\Controllers\MediaController@makeDirectory');
Route::delete('media/{id}', 'Webelightdev\LaravelMediaManager\Controllers\MediaController@destroy');
Route::get('media', 'Webelightdev\LaravelMediaManager\Controllers\MediaController@getAllMedia');
Route::get('media/search', 'Webelightdev\LaravelMediaManager\Controllers\MediaController@getMediaBySearch');