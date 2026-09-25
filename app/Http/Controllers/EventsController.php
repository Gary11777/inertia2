<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function show(Event $event)
    {
        return Inertia::render('event/Show', [
            'event' => $event->only(
                'id',
                'title',
                'start_date',
                'description'
            ),
        ]);
    }

    public function index()
    {
        return Inertia::render('event/Index', [
            'events' => Event::query()
            ->orderBy('id')
            ->get(['id', 'title', 'start_date']),
        ]);
    }
}