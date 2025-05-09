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

        Contact::create($validated);

        return redirect()->route('client.contact')->with('contact_success', 'Thank you for your message! We will get back to you shortly.');
    }

    // ADMIN SIDE
    public function index()
    {
        $messages = Contact::latest()->get();
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
            'reply_message' => 'required|string|max:2000',
        ]);

        $contact = Contact::findOrFail($id);

        // Send email reply
        Mail::to($contact->email)->send(new ContactFormMail([
            'name' => $contact->name,
            'email' => $contact->email,
            'original_message' => $contact->message,
            'reply_message' => $request->input('reply_message'),
        ]));

        return redirect()->route('contact.index')->with('success', 'Reply sent successfully!');
    }
}
