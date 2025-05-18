@extends('layouts.app')

@section('title', 'Employee Profile')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 800px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Employee Profile</h2>
            <a href="{{ route('home') }}" title="Back" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employees.updateProfile') }}">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div style="background-color: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li style="color: #721c24;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #F9F9F9;">

                <div style="margin-bottom: 20px;">
                    <label for="name" style="font-weight: bold;">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="font-weight: bold;">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="phone" style="font-weight: bold;">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="address_line1" style="font-weight: bold;">Address Line 1</label>
                    <input type="text" id="address_line1" name="address_line1" value="{{ old('address_line1', $employee->address_line1) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="address_line2" style="font-weight: bold;">Address Line 2</label>
                    <input type="text" id="address_line2" name="address_line2" value="{{ old('address_line2', $employee->address_line2) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="city" style="font-weight: bold;">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city', $employee->city) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="postal_code" style="font-weight: bold;">Postal Code</label>
                    <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $employee->postal_code) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px;">
    <a href="{{ route('employees.changePasswordForm') }}" class="btn btn-outline-secondary"
       style="padding: 10px 20px; text-decoration: none; border: 1px solid #ccc; border-radius: 5px;">
        Change Password
    </a>

    <button type="submit"
            style="background-color: #E7592B; color: white; font-size: 14px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
        Update Profile
    </button>
</div>
        </form>
    </div>
</div>
@endsection
