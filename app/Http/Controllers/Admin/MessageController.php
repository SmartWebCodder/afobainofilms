<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::query()
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->when($request->search, fn($q, $s) => $q->where('name', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Admin/Messages/Index', [
            'messages' => $messages,
            'filters' => $request->only(['status', 'search']),
            'unreadCount' => Message::unread()->count(),
        ]);
    }

    public function show(Message $message)
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return Inertia::render('Admin/Messages/Show', [
            'message' => $message,
        ]);
    }

    public function updateStatus(Request $request, Message $message)
    {
        $data = $request->validate([
            'status' => ['required', 'in:unread,read,starred,archived'],
        ]);

        $message->update($data);

        return back()->with('success', 'Status updated.');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted.');
    }
}
