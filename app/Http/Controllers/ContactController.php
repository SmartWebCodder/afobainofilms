<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'event_date' => ['nullable', 'string', 'max:50'],
            'event_venue' => ['nullable', 'string', 'max:255'],
            'referral_source' => ['nullable', 'string', 'max:255'],
            'event_type' => ['nullable', 'string'],
            'vision' => ['nullable', 'string', 'max:2000'],
        ]);

        Message::create($data);

        return back()->with('success', 'Message sent successfully!');
    }
}
