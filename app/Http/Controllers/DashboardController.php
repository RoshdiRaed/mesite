<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMessages  = Contact::count();
        $unreadMessages = Contact::where('is_read', false)->count();
        $recentMessages = Contact::latest()->take(5)->get();

        return view('dashboard.index', compact('totalMessages', 'unreadMessages', 'recentMessages'));
    }

    public function messages()
    {
        $messages = Contact::latest()->paginate(15);

        return view('dashboard.messages', compact('messages'));
    }

    public function toggleRead(Contact $contact)
    {
        $contact->update(['is_read' => !$contact->is_read]);

        return back()->with('success', 'Message status updated.');
    }

    public function destroyMessage(Contact $contact)
    {
        $contact->delete();

        return back()->with('success', 'Message deleted.');
    }
}
