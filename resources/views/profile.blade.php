{{-- resources/views/profile.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Flame & Crust</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

@include('partials.header')



<div class="container">
    <h2>Welcome, {{ $user->name }}</h2>
    <p>{{ \Carbon\Carbon::now()->format('D, d M Y') }}</p>

    <div class="profile-card">
        <div class="info">
            <h3>{{ $user->name }}</h3>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Contact:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
            <p><strong>Are you a Loyalty Customer:</strong> {{ $user->loyalty_points ?? 0 }} Points</p>
        </div>
    </div>



    <br>
    <br>





    <!-- Add the Edit Modal -->
<div class="edit-modal" id="editModal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Edit Profile</h2>

        <form id="profileForm" action="{{ route('profile.update', ['user' => $user->user_id]) }}" method="POST" onsubmit="return confirmEdit()">

            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="error-messages">
                <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address">{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" name="password_confirmation" placeholder="Re-enter new password">
            </div>


            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Client-side form validation
    document.querySelector('form').addEventListener('submit', function(event) {
        let isValid = true;
        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const phone = document.querySelector('input[name="phone"]').value;

        // Validate Name
        if (name.trim() === '') {
            alert('Name is required.');
            isValid = false;
        }

        // Validate Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            isValid = false;
        }

        // Validate Phone (if provided)
        if (phone.trim() !== '' && !/^\d{10}$/.test(phone)) {
            alert('Please enter a valid phone number (10 digits).');
            isValid = false;
        }

        // Validate Password (if provided)
        const password = document.querySelector('input[name="password"]').value;
        if (password.trim() !== '') {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/;
            if (!passwordRegex.test(password)) {
                alert('Password must be at least 8 characters and include uppercase, lowercase, number, and special character.');
                isValid = false;
            }
        }


        // If not valid, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

<!-- Edit Button -->
<a href="#" class="btn-edit" id="editBtn">Edit Profile Details</a>


<script>
    const editBtn = document.getElementById('editBtn');
    const modal = document.getElementById('editModal');
    const closeModal = document.getElementById('closeModal');

    // Open the modal when Edit button is clicked
    editBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close the modal if user clicks outside the modal
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>



<!-- Change Password Button -->
<a href="#" class="btn-edit" id="changePasswordBtn">Change Password</a>


<script>
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const changePasswordModal = document.getElementById('changePasswordModal');
    const closeChangePasswordModal = document.getElementById('closeChangePasswordModal');

    changePasswordBtn.addEventListener('click', () => {
        changePasswordModal.style.display = 'block';
    });

    closeChangePasswordModal.addEventListener('click', () => {
        changePasswordModal.style.display = 'none';
    });

    window.onclick = function(event) {
        if (event.target === changePasswordModal) {
            changePasswordModal.style.display = 'none';
        }
    };
</script>

<script>
    function validatePasswordChange() {
        const newPassword = document.querySelector('input[name="new_password"]').value;
        const confirmPassword = document.querySelector('input[name="new_password_confirmation"]').value;

        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/;

        if (!passwordRegex.test(newPassword)) {
            alert('New password must be at least 8 characters and include uppercase, lowercase, number, and special character.');
            return false;
        }

        if (newPassword !== confirmPassword) {
            alert('New password and confirmation do not match.');
            return false;
        }

        return true;
    }
</script>




@if ($errors->any())
    <script>
        window.addEventListener('load', function () {
            document.getElementById('editModal').style.display = 'block';
        });
    </script>
@endif




@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif




    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

      <div class="button-group">


        <a href="{{ route('profile.orders') }}" class="btn">View Order History</a>
    </div>

</div>


<div class="profile-sections">

    <!-- Wishlist Section -->
    <div class="profile-card">
        <h3><i class="fas fa-heart"></i> Wishlist</h3>
        <p>You haven't added any items to your wishlist yet.</p>
        {{-- Later you can loop through wishlist items here --}}
        {{-- @foreach($wishlist as $item) --}}
        {{--     <p>{{ $item->product_name }}</p> --}}
        {{-- @endforeach --}}
    </div>

    <!-- Shopping Cart Section -->
    <div class="profile-card">
        <h3><i class="fas fa-shopping-cart"></i> Shopping Cart</h3>
        <p>Your shopping cart is currently empty.</p>
        {{-- Later you can loop through cart items here --}}
        {{-- @foreach($cart as $item) --}}
        {{--     <p>{{ $item->product_name }} - Qty: {{ $item->quantity }}</p> --}}
        {{-- @endforeach --}}
    </div>

</div>




@include('partials.footer')


</body>
</html>
