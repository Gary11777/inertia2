<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventsController;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/events/{event}', [EventsController::class, 'show'])
    ->name('events.show');

Route::get('/events', [EventsController::class, 'index'])
    ->name('events.index');