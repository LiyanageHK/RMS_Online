<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Handle the registration logic.
     */
    public function store(Request $request)
    {
        // Custom error messages
        $messages = [
            'password.regex' => 'Password must contain at least one uppercase letter, 1 lowercase letter, 1 digit, and 1 special character.',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
            'phone.unique' => 'This phone number is already registered.',
        ];

        // Validate incoming registration data
        $data = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'          => ['required', 'digits:10', 'unique:users'],
            'address'        => ['required', 'string', 'max:255'],
            'password'       => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',       // At least one lowercase letter
                'regex:/[A-Z]/',       // At least one uppercase letter
                'regex:/[0-9]/',       // At least one digit
                'regex:/[@$!%*?&#]/',  // At least one special character
            ],
            'profile_image'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], $messages);

        // Handle profile image upload if available
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Hash the password before storing it
        $hashedPassword = Hash::make($data['password']);

        // Create and store the new user
        $user = User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'password'      => Hash::make($data['password']),
            'profile_image' => $profileImagePath,
        ]);





        // Auto-login the user after successful registration
        Auth::login($user);

        // Redirect to home page or dashboard
        return redirect('/')->with('success', 'Registration successful! Welcome to Flame & Crust!.');
    }











}








