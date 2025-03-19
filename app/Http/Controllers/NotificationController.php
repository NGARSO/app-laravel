<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        $recipients = User::all(); 
        return view('notifications.index', compact('notifications','recipients'));
    }

    public function create()
    {
        $recipients = User::all();
        return view('notifications.create', compact('recipients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required',
            'recipient_id' => 'required|exists:users,id',
            'sent_at' => 'required|date',
        ]);

        Notification::create($validated);
        return redirect()->route('notifications.index')->with('success', 'Notification sent successfully.');
    }

    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    public function edit(Notification $notification)
    {
        $recipients = User::all();
        return view('notifications.edit', compact('notification', 'recipients'));
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'message' => 'required',
            'recipient_id' => 'required|exists:users,id',
            'sent_at' => 'required|date',
        ]);

        $notification->update($validated);
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}