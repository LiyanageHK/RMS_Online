@extends('layouts.admin')

@section('title', 'Edit Supplier')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 800px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Edit Supplier</h2>
            <a href="{{ route('suppliers.index') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
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

                {{-- General Information --}}
                <div style="margin-bottom: 20px;">
                    <label for="name" style="font-weight: bold;">Supplier Name <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $supplier->name) }}" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
    <label for="category" style="font-weight: bold;">Category <span style="color: red;">*</span></label>
    <select id="category" name="category" required
            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <option value="">-- Select Category --</option>
        <option value="Vegetables" {{ old('category', $supplier->category) == 'Vegetables' ? 'selected' : '' }}>Vegetables</option>
        <option value="Meat" {{ old('category', $supplier->category) == 'Meat' ? 'selected' : '' }}>Meat</option>
        <option value="Seafood" {{ old('category', $supplier->category) == 'Seafood' ? 'selected' : '' }}>Dairy</option>
    </select>
</div>

                <div style="margin-bottom: 20px;">
                    <label for="email" style="font-weight: bold;">Email <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $supplier->email) }}" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="email-error" style="color: red; display: none;">Please enter a valid email address.</small>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="phone" style="font-weight: bold;">Phone <span style="color: red;">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}" required
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="phone-error" style="color: red; display: none;">Please enter a valid phone number (+94XXXXXXXXX).</small>
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="address" style="font-weight: bold;">Address</label>
                    <textarea id="address" name="address" rows="3"
                              style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ old('address', $supplier->address) }}</textarea>
                </div>

                {{-- Contact Person --}}
                <h4 style="font-weight: bold; margin-bottom: 10px;">Contact Person</h4>

                <div style="margin-bottom: 20px;">
                    <label for="contact_person_name" style="font-weight: bold;">Name</label>
                    <input type="text" id="contact_person_name" name="contact_person_name"
                           value="{{ old('contact_person_name', $supplier->contact_person_name) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="contact_person_phone" style="font-weight: bold;">Phone</label>
                    <input type="text" id="contact_person_phone" name="contact_person_phone"
                           value="{{ old('contact_person_phone', $supplier->contact_person_phone) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="contact-person-phone-error" style="color: red; display: none;">Please enter a valid phone number (+94XXXXXXXXX).</small>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="contact_person_email" style="font-weight: bold;">Email</label>
                    <input type="email" id="contact_person_email" name="contact_person_email"
                           value="{{ old('contact_person_email', $supplier->contact_person_email) }}"
                           style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small id="contact-person-email-error" style="color: red; display: none;">Please enter a valid email address.</small>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <button type="submit"
                        style="background-color: #E7592B; color: white; font-size: 14px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Update Supplier
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function validateEmail() {
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('email-error');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        emailError.style.display = email.match(emailPattern) ? 'none' : 'block';
    }

    function validatePhone() {
        const phone = document.getElementById('phone').value;
        const phoneError = document.getElementById('phone-error');
        const phonePattern = /^\+94[0-9]{9}$/;
        phoneError.style.display = phone.match(phonePattern) ? 'none' : 'block';
    }

    function validateContactPersonPhone() {
        const phone = document.getElementById('contact_person_phone').value;
        const phoneError = document.getElementById('contact-person-phone-error');
        const phonePattern = /^\+94[0-9]{9}$/;
        phoneError.style.display = phone.match(phonePattern) ? 'none' : 'block';
    }

    function validateContactPersonEmail() {
        const email = document.getElementById('contact_person_email').value;
        const emailError = document.getElementById('contact-person-email-error');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        emailError.style.display = email.match(emailPattern) ? 'none' : 'block';
    }

    document.getElementById('email').addEventListener('input', validateEmail);
    document.getElementById('phone').addEventListener('input', validatePhone);
    document.getElementById('contact_person_phone').addEventListener('input', validateContactPersonPhone);
    document.getElementById('contact_person_email').addEventListener('input', validateContactPersonEmail);
</script>
@endsection
