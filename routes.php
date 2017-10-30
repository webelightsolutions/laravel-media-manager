<?php
Route::get('media', 'Webelightdev\LaravelMediaManager\Controller\MediaController@create');
Route::post('media/store', 'Webelightdev\LaravelMediaManager\Controller\MediaController@store');
