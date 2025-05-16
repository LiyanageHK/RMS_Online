<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Show the login form
    public function create()
    {
        Log::info('LoginController@create called');
        return view('auth.login');
    }

    // Handle the login form submission (for employees/admins)
    public function store(Request $request)
    {
        Log::info('LoginController@store called', ['request' => $request->all()]);

        // Validate the login data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // Attempt to log the employee in using the 'admin' guard
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('LoginController@store: Login successful', ['email' => $credentials['email']]);
            return redirect()->intended('/admin/home');  // Redirect to admin dashboard after login
        }

        // If login fails, return with an error
        Log::warning('LoginController@store: Login failed', ['email' => $credentials['email']]);
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    protected function authenticated(Request $request, $employee)
    {
        Log::info('LoginController@authenticated called', ['employee_id' => $employee->id ?? null]);
        return redirect('/admin/home');
    }

    // Logout the employee (admin)
    public function destroy(Request $request)
    {
        Log::info('LoginController@destroy called', ['user_id' => Auth::guard('admin')->id()]);
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}





