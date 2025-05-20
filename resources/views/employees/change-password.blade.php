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

        <form method="POST" action="{{ route('employees.changePassword') }}" id="changePasswordForm">
            @csrf
            <input type="hidden" name="confirm_change" id="confirm_change" value="0">

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

        <!-- Custom Confirmation Modal -->
        <div id="confirmPasswordModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
            <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
                <div style="margin-bottom: 15px;">
                    <span class="material-icons" style="font-size: 40px; color: #E7592B;">lock_reset</span>
                </div>
                <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Password Change</h4>
                <p style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to change your password? You will be logged out and will have to log in again.</p>
                <div style="display: flex; justify-content: center; gap: 15px;">
                    <button id="cancelPasswordBtn" type="button" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                    <button id="confirmPasswordBtn" type="button" style="padding: 10px 20px; background-color: #E7592B; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Change Password</button>
                </div>
            </div>
        </div>

        <script>
        const form = document.getElementById('changePasswordForm');
        const confirmInput = document.getElementById('confirm_change');
        const confirmModal = document.getElementById('confirmPasswordModal');
        const cancelBtn = document.getElementById('cancelPasswordBtn');
        const confirmBtn = document.getElementById('confirmPasswordBtn');

        form.addEventListener('submit', function(e) {
            if (confirmInput.value === '1') {
                // Show custom confirmation modal
                e.preventDefault();
                confirmModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            } else {
                // First submit: set flag and prevent submit
                e.preventDefault();
                confirmInput.value = '1';
                form.requestSubmit();
            }
        });

        cancelBtn.addEventListener('click', function() {
            confirmModal.style.display = 'none';
            document.body.style.overflow = '';
            confirmInput.value = '0';
        });

        confirmBtn.addEventListener('click', function() {
            confirmModal.style.display = 'none';
            document.body.style.overflow = '';
            // Actually submit the form
            form.submit();
        });
        </script>
    </div>
</div>
@endsection
