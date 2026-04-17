<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Project;
use App\Models\Testimonial;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalProjects' => Project::count(),
                'publishedProjects' => Project::published()->count(),
                'totalMessages' => Message::count(),
                'unreadMessages' => Message::unread()->count(),
                'totalTestimonials' => Testimonial::count(),
            ],
            'recentMessages' => Message::latest()
                ->take(5)
                ->get()
                ->map(fn($m) => [
                    'id' => $m->id,
                    'name' => $m->name,
                    'email' => $m->email,
                    'event_type' => $m->event_type,
                    'status' => $m->status,
                    'created_at' => $m->created_at->diffForHumans(),
                ]),
        ]);
    }
}
