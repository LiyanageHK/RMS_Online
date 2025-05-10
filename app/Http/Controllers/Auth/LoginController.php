<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function create()
    {
        return view('login');
    }

    // Handle the login form submission
    public function store(Request $request)
    {
        // Validate the login data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');  // Redirect to home page after login
        }

        // If login fails, return with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect('/');
    }



public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        //$request->session()->regenerate();
        return redirect()->intended(route('home'));
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}



    // Logout the user
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}


