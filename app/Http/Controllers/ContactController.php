<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;

class ContactController extends Controller
{
    // CLIENT SIDE
    public function show()
    {
        return view('client.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $validated['status'] = 'Pending';
        Contact::create($validated);

        return redirect()->route('contact')->with('contact_success', 'Thank you for your message! We will get back to you shortly.');
    }

    // ADMIN SIDE
    public function index(Request $request)
    {
        $query = Contact::query();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('message', 'like', "%$search%");
            });
        }
        $messages = $query->latest()->get();
        return view('contact.index', compact('messages'));
    }

    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        return view('contact.show', compact('message'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $contact = Contact::findOrFail($id);

        // Send email reply
        \Mail::to($contact->email)->send(new \App\Mail\ContactReplyMail(
            $contact->name,
            $contact->email,
            $contact->message,
            $request->input('reply')
        ));

        $contact->status = 'Resolved';
        $contact->save();

        return redirect()->route('contact.index')->with('success', 'Reply sent successfully!');
    }
}
