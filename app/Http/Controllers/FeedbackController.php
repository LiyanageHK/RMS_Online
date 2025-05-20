<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // CLIENT SIDE
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'feedback' => 'required|string',
        ]);

        Feedback::create($validated);

        return redirect()->back()->with('feedback_success', 'Thank you for your feedback!');
    }

    // ADMIN SIDE
    public function index(Request $request)
    {
        $query = Feedback::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $feedbacks = $query->latest()->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('feedback.show', compact('feedback'));
    }
}
