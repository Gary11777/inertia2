<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventsController;
use App\Models\Event;
use App\Models\Article;

Route::get('/', function () {
    return Inertia::render('Home', [
        'articles' => Article::query()
            ->latest('published_at')
            ->get()
            ->map(fn (Article $article) => [
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'published_at' => $article->published_at->format('Y-m-d'),
                'author_name' => $article->author_name,
                'author_email' => $article->author_email,
            ]),

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