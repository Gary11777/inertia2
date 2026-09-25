<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventsController;
use App\Models\Event;

Route::get('/', function () {
    return Inertia::render('Home', [
        'events' => Inertia::optional(fn () => Event::query()
            ->orderBy('id')
            ->get(['id', 'title', 'start_date'])),
    ]);
});

Route::inertia('/about', 'About');

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/events/{event}', [EventsController::class, 'show'])
    ->name('events.show');

Route::get('/events', [EventsController::class, 'index'])
    ->name('events.index');