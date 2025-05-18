@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 800px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Change Password</h2>
            <a href="{{ route('employees.profile') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        @if (session('success'))
            <div style="background-color: #d4edda; padding: 12px 15px; border-radius: 5px; margin-bottom: 20px; color: #155724; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employees.changePassword') }}">
            @csrf

            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #F9F9F9;">

                <div style="margin-bottom: 20px;">
                    <label for="current_password" style="font-weight: bold;">Current Password <span style="color: red;">*</span></label>
                    <input type="password" id="current_password" name="current_password" required
                           class="@error('current_password') is-invalid @enderror"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    @error('current_password')
                        <div style="color: red; font-size: 14px; margin-top: 5px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="new_password" style="font-weight: bold;">New Password <span style="color: red;">*</span></label>
                    <input type="password" id="new_password" name="new_password" required
                           class="@error('new_password') is-invalid @enderror"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    @error('new_password')
                        <div style="color: red; font-size: 14px; margin-top: 5px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="new_password_confirmation" style="font-weight: bold;">Confirm New Password <span style="color: red;">*</span></label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 30px;">
                <button type="submit"
                        style="background-color: #E7592B; color: white; font-size: 14px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Change Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
