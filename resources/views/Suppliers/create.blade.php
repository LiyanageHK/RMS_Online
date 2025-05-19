@extends('layouts.app')

@section('title', 'Create Supplier')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 1000px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <!-- Title + Cancel Button -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Create Supplier</h2>
            <a href="{{ route('suppliers.index') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

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

            <!-- Supplier Details -->
            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; background-color: #F9F9F9; margin-bottom: 20px;">
                <h4 style="font-weight: bold; margin-bottom: 20px;">General Information</h4>

                <div style="margin-bottom: 15px;">
                    <label for="name" style="font-weight: bold;">Supplier Name <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter Supplier Name" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="category" style="font-weight: bold;">Category <span style="color: red;">*</span></label>
                    <select id="category" name="category" required style="width: 99%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="" style="font-weight: bold;">-- Select Category --</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}" {{ old('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="email" style="font-weight: bold;">Email Address <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="example@example.com" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="email-error" style="color: red; display: none;">Please enter a valid email address.</small>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="phone" style="font-weight: bold;">Contact Number <span style="color: red;">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+94XXXXXXXXX" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="phone-error" style="color: red; display: none;">Please enter a valid phone number (+94XXXXXXXXX).</small>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="address" style="font-weight: bold;">Address <span style="color: red;">*</span></label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required placeholder="Enter Address" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <!-- Optional Contact Person Section -->
            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; background-color: #F9F9F9;">
                <h4 style="font-weight: bold; margin-bottom: 20px;">Contact Person Details (optional)</h4>

                <div style="display: flex; gap: 20px; margin-bottom: 15px;">
                    <div style="flex: 1;">
                        <label for="contact_person_name" style="font-weight: bold;">Name</label>
                        <input type="text" id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name') }}" placeholder="Enter Conatct Person Name" style="width: 93%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="flex: 1;">
                        <label for="contact_person_phone" style="font-weight: bold;">Contact Number</label>
                        <input type="text" id="contact_person_phone" name="contact_person_phone" value="{{ old('contact_person_phone') }}" placeholder="+94XXXXXXXXXr" style="width: 93%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <small id="contact-person-phone-error" style="color: red; display: none;">Please enter a valid phone number (+94XXXXXXXXX).</small>
                    </div>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="contact_person_email" style="font-weight: bold;">Email Address</label>
                    <input type="email" id="contact_person_email" name="contact_person_email" value="{{ old('contact_person_email') }}" placeholder="example@example.com" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="contact-person-email-error" style="color: red; display: none;">Please enter a valid email address.</small>
                </div>
            </div>

            <!-- Submit Button -->
            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <button type="submit" style="background-color: #E7592B; color: white; font-size: 16px; padding: 12px 50px; border: none; border-radius: 5px; cursor: pointer;">
                    Save 
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

    // Real-time validation for contact person phone
    function validateContactPersonPhone() {
        const phone = document.getElementById('contact_person_phone').value;
        const phoneError = document.getElementById('contact-person-phone-error');
        const phonePattern = /^\+94[0-9]{9}$/;
        
        if (!phone.match(phonePattern)) {
            phoneError.style.display = 'block';
        } else {
            phoneError.style.display = 'none';
        }
    }

    // Real-time validation for contact person email
    function validateContactPersonEmail() {
        const email = document.getElementById('contact_person_email').value;
        const emailError = document.getElementById('contact-person-email-error');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        
        if (!email.match(emailPattern)) {
            emailError.style.display = 'block';
        } else {
            emailError.style.display = 'none';
        }
    }

    // Attach validation handlers
    document.getElementById('email').addEventListener('input', validateEmail);
    document.getElementById('phone').addEventListener('input', validatePhone);
    document.getElementById('contact_person_phone').addEventListener('input', validateContactPersonPhone);
    document.getElementById('contact_person_email').addEventListener('input', validateContactPersonEmail);
</script>
@endsection
