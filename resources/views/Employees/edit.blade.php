@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 800px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Edit Employee</h2>
            <a href="{{ route('employees.index') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Display Validation Errors -->
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
                
                {{-- General Info --}}
                <div style="margin-bottom: 20px;">
                    <label for="name" style="font-weight: bold;">Name <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="font-weight: bold;">Email <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" required
                           oninput="validateEmail()" placeholder="example@example.com"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="email-error" style="color: red; display: none;">Please enter a valid email address.</small>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="nic" style="font-weight: bold;">NIC <span style="color: red;">*</span></label>
                    <input type="text" id="nic" name="nic" value="{{ old('nic', $employee->nic) }}" readonly
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; background-color: #eee; border-radius: 5px;">
                    <input type="hidden" name="nic" value="{{ old('nic', $employee->nic) }}">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="phone" style="font-weight: bold;">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}"
                           oninput="validatePhone()" placeholder="+94XXXXXXXXX"
                           pattern="^\+94[0-9]{9}$"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="phone-error" style="color: red; display: none;">Please enter a valid phone number (+94XXXXXXXXX).</small>
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="position" style="font-weight: bold;">Position <span style="color: red;">*</span></label>
                    <input type="text" readonly value="{{ $employee->position }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; background-color: #eee; border-radius: 5px;">
                    <input type="hidden" name="position" value="{{ $employee->position }}">
                </div>


                {{-- Address Info --}}

                <div style="margin-top: 20px; margin-bottom: 20px;">
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

            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <button type="submit"
                        style="background-color: #E7592B; color: white; font-size: 14px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Update Employee
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Real-time validation for email
    function validateEmail() {
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('email-error');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (!email.match(emailPattern)) {
            emailError.style.display = 'block';
        } else {
            emailError.style.display = 'none';
        }
    }

    // Real-time validation for phone number
    function validatePhone() {
        const phone = document.getElementById('phone').value;
        const phoneError = document.getElementById('phone-error');
        const phonePattern = /^\+94[0-9]{9}$/;

        if (!phone.match(phonePattern)) {
            phoneError.style.display = 'block';
        } else {
            phoneError.style.display = 'none';
        }
    }
</script>

@endsection
