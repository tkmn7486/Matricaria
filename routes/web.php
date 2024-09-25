<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

// ->withoutMiddleware(ValidateCsrfToken::class) でcsrf無効化中

Route::get('/event', [EventController::class, 'getAllEvents']);
Route::get('/event/{id}', [EventController::class, 'getEventById']);
Route::get('/event/{event_id}/comment', [EventController::class, 'getCommentById']);
Route::post('/event/create', [EventController::class, 'createEvent'])->withoutMiddleware(ValidateCsrfToken::class);
Route::post('/comment/create/{event_id}', [EventController::class, 'createComment'])->withoutMiddleware(ValidateCsrfToken::class);
Route::post('/comment/{id}', [EventController::class, 'updateComment'])->withoutMiddleware(ValidateCsrfToken::class);
Route::delete('/comment/{id}', [EventController::class, 'deleteComment'])->withoutMiddleware(ValidateCsrfToken::class);