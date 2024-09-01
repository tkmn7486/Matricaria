<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/event', 'App\Http\Controllers\EventController@getAllEvents');
Route::get('/event/{id}', 'App\Http\Controllers\EventController@getEventById');
Route::post('/event/create', 'App\Http\Controllers\EventController@createEvent');
