@extends('layouts.appclient')
   
    <style>
        :root {
            --primary-orange: #E7592B;
            --light-red: #ff6b6b;
            --dark-bg: #1a1a1a;
            --light-bg: #f9f9f9;
            --text-dark: #333;
            --text-light: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: var(--light-bg);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: var(--text-light);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            background-color:black;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            font-size: 28px;
            color: var(--primary-orange);
            margin-left: 10px;
        }

        .logo span {
            display: block;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            letter-spacing: 2px;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: var(--primary-orange);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            padding-top: 80px;
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            background-color: var(--text-light);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .feature-item {
            padding: 20px;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
        }

        .feature-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .feature-title {
            color: var(--primary-orange);
            font-size: 24px;
            margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
        }

        .feature-description {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h2 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary-orange);
            color: var(--text-light);
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--primary-orange);
        }

        /* Pizza Sizes Section */
        .pizza-sizes {
            padding: 80px 0;
            background-color: var(--light-bg);
            text-align: center;
        }

        .sizes-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .size-item {
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .size-title {
            color: var(--primary-orange);
            font-size: 32px;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .size-subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .pizza-image {
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            background-color: #f8f8f8;
        }

        .pizza-image:hover {
            transform: scale(1.05);
        }

        .pizza-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .pizza-image.large {
            width: 260px;
            height: 260px;
        }

        .pizza-image.medium {
            width: 200px;
            height: 200px;
        }

        .pizza-image.small {
            width: 140px;
            height: 140px;
        }

        @media (max-width: 768px) {
            .sizes-container {
                flex-direction: column;
                align-items: center;
            }

            .size-item {
                width: 100%;
                max-width: 300px;
            }

            .pizza-image.large {
                width: 200px;
                height: 200px;
            }

            .pizza-image.medium {
                width: 160px;
                height: 160px;
            }

            .pizza-image.small {
                width: 120px;
                height: 120px;
            }
        }

        /* Pizza Specials */
        .specials {
            padding: 80px 0;
            background-color: var(--text-light);
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 36px;
            color: var(--primary-orange);
            margin-bottom: 15px;
        }

        .section-title p {
            max-width: 700px;
            margin: 0 auto;
        }

        .pizza-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .pizza-card {
            background-color: var(--light-bg);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .pizza-card:hover {
            transform: translateY(-10px);
        }

        .pizza-img {
            height: 200px;
            overflow: hidden;
        }

        .pizza-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .pizza-card:hover .pizza-img img {
            transform: scale(1.1);
        }

        .pizza-info {
            padding: 20px;
        }

        .pizza-info h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: var(--primary-orange);
        }

        .pizza-info p {
            margin-bottom: 15px;
            color: #666;
        }

        .price {
            font-weight: 700;
            color: var(--primary-orange);
            font-size: 18px;
        }

        /* Testimonials */
        .testimonials {
            padding: 80px 0;
            background-color: var(--dark-bg);
            color: var(--text-light);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .testimonial-card {
            background-color: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 10px;
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            font-size: 80px;
            position: absolute;
            top: 10px;
            left: 20px;
            color: rgba(255,255,255,0.1);
            font-family: serif;
        }

        .testimonial-card p {
            margin-bottom: 20px;
            font-style: italic;
        }

        .customer-name {
            font-weight: 600;
            color: var(--light-red);
        }

        /* Footer */
        footer {
            background-color: var(--dark-bg);
            color: var(--text-light);
            padding: 60px 0 20px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            margin-bottom: 20px;
        }

        .footer-logo h2 {
            font-size: 28px;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .footer-logo span {
            display: block;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .footer-about p {
            margin-bottom: 20px;
        }

        .footer-links h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--text-light);
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 10px;
        }

        .footer-links ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links ul li a:hover {
            color: var(--light-red);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #999;
            font-size: 14px;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--primary-orange);
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .header-container {
                padding: 15px;
            }

            nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background-color: var(--text-light);
                transition: left 0.3s;
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
                padding: 20px;
            }

            nav ul li {
                margin: 15px 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero h2 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
            }
        }
    </style>



@section('title', 'Home')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="container">
    <h2>Welcome, {{ $user->name }}</h2>
    <p>{{ \Carbon\Carbon::now()->format('D, d M Y') }}</p>

    <div class="profile-card">
        <div class="info">
            <h3>{{ $user->name }}</h3>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Contact:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>

            @if(isset($loyalty))
                <p><strong>Loyalty Level:</strong>
                    <span class="loyalty-badge {{ strtolower($loyalty->loyalty_level) }}">
                        {{ $loyalty->loyalty_level }}
                    </span>
                </p>
@endif

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


<div class="profile-sections icon-only">

  <!-- Floating Shopping Cart Icon -->
<a href="#" class="floating-cart" title="Shopping Cart">
    <i class="fas fa-shopping-cart fa-2x"></i>
</a>

@endsection