<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>


    <header>
        <div class="container header-container">
            <div class="logo">
                {{-- <img src="https://via.placeholder.com/50/ff0000/ffffff?text=FC" alt="Flame & Crust Logo"> --}}
                <div>
                    <h1>FLAME & CRUST</h1>
                    <span>PIZZARIA</span>
                </div>
            </div>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <nav id="mainNav">
                <ul>
                    <li><a href="{{ route('home') }}" @if(Request::routeIs('home')) class="active" @endif>HOME</a></li>
                    <li><a href="{{ route('menu') }}" @if(Request::routeIs('menu')) class="active" @endif>MENU</a></li>
                    <li><a href="{{ route('about') }}" @if(Request::routeIs('about')) class="active" @endif>ABOUT US</a></li>
                    <li><a href="{{ route('contact') }}" @if(Request::routeIs('contact')) class="active" @endif>CONTACT US</a></li>
                    @auth
                        <li><span class="username">{{ Auth::user()->name }}</span></li>
                    @else
                        <li><a href="{{ route('login') }}">LOGIN</a></li>
                    @endauth


                </ul>
            </nav>
        </div>
    </header>

<div class="container">
    <h2>Welcome, {{ $user->name }}</h2>
    <p>{{ \Carbon\Carbon::now()->format('D, d M Y') }}</p>

    <div class="profile-card">
     <!--     <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" />   -->

        <div class="info">
            <h3>{{ $user->name }}</h3>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Contact:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
            <p><strong>Loyalty Points:</strong> {{ $user->loyalty_points ?? 0 }} Points</p>
        </div>


    </div>
</div>

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





<div class="order-history-section container">
    <div class="order-header">
        <h2>Order History</h2>
        <a href="{{ route('menu') }}" class="btn-order">Place New Order</a>
    </div>

    <table class="order-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Items</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>#{{ $order->order_number }}</td>
                    <td>{{ implode(', ', $order->items->pluck('name')->toArray()) }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">You have no previous orders.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>






<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-about">
                <div class="footer-logo">
                    <h2>FLAME & CRUST</h2>
                    <span>PIZZARIA</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Pizza Street, Food City</li>
                    <li><i class="fas fa-phone"></i> (123) 456-7890</li>
                    <li><i class="fas fa-envelope"></i> info@flameandcrust.com</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} Flame & Crust Pizzeria. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/login.js') }}"></script>
<script src="{{ asset('js/register.js') }}"></script>

<script>
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mainNav = document.getElementById('mainNav');

    mobileMenuBtn.addEventListener('click', () => {
        mainNav.classList.toggle('active');
    });

    // Close menu when clicking on a link
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            mainNav.classList.remove('active');
        });
    });
</script>


</body>
</html>
