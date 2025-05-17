@include('partials.header')
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





@section('content')


{{-- 
<header>
    <div class="header-container">
        <div class="logo" style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('uploads/logo/logo2.png') }}" alt="Flame & Crust Pizzeria Logo" style="width: 80px; height: auto;">
            <h1 style="color: #fff; font-size: 1.5rem; margin: 0;">FLAME & CRUST PIZZERIA</h1>
        </div>
        <button class="mobile-menu-btn" id="mobileMenuBtn" style="background: none; border: none; color: #fff; font-size: 1.5rem; display: none;">
            <i class="fas fa-bars"></i>
        </button>
        <nav id="mainNav">
            <ul style="display: flex; gap: 30px; list-style: none; margin: 0; padding: 0; align-items: center;">
                <li><a href="{{ route('welcome') }}" @if(Request::routeIs('welcome')) class="active" @endif>HOME</a></li>
                <li><a href="{{ route('menu') }}" @if(Request::routeIs('menu')) class="active" @endif>MENU</a></li>
                <li><a href="{{ route('about') }}" @if(Request::routeIs('about')) class="active" @endif>ABOUT US</a></li>
                <li><a href="{{ route('contact') }}" @if(Request::routeIs('contact')) class="active" @endif>CONTACT US</a></li>
                @guest
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                @endguest
                @auth
                    <li class="user-dropdown" style="position: relative;">
                        <a href="#" id="userMenuBtn" style="display: flex; align-items: center;">{{ Auth::user()->name }} <i class="fas fa-caret-down" style="margin-left: 5px;"></i></a>
                        <ul class="user-menu" id="userMenu" style="display: none; position: absolute; top: 100%; right: 0; background: #222; padding: 10px 0; min-width: 140px; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 100;">
                            <li><a href="{{ route('profile') }}" style="color: #fff; padding: 8px 20px; display: block;">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; color: #fff; padding: 8px 20px; width: 100%; text-align: left; cursor: pointer;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header> --}}

<script>
    // Show/hide user dropdown menu
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userMenu = document.getElementById('userMenu');
        if(userMenuBtn && userMenu) {
            userMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', function(e) {
                if (!userMenu.contains(e.target) && e.target !== userMenuBtn) {
                    userMenu.style.display = 'none';
                }
            });
        }
    });
</script>
<section class="container" style="padding: 40px 20px; text-align: center;">
    <h2 style="color: var(--primary-red); margin-bottom: 20px;">Discover Our Passion for Pizza</h2>
    <p style="max-width: 800px; margin: 0 auto 30px;">
        At Flame & Crust, we blend tradition with creativity to craft pizzas that ignite your taste buds. Whether you're craving the classics or something adventurous, our wood-fired goodness will leave you coming back for more.
    </p>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin-top: 20px;">
        <div style="max-width: 300px;">
            <h3 style="margin-top: 15px;">Fresh Ingredients</h3>
            <p>Locally sourced and always fresh — that’s our promise to you.</p>
        </div>
        <div style="max-width: 300px;">
            <h3 style="margin-top: 15px;">Wood-Fired Perfection</h3>
            <p>Our traditional oven gives each pizza its irresistible smoky flavor.</p>
        </div>
        <div style="max-width: 300px;">
            <h3 style="margin-top: 15px;">Family-Friendly Vibe</h3>
            <p>Bring your loved ones for a cozy and delicious dining experience.</p>
        </div>
    </div>
</section>

@include('partials.footer')
<script>
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mainNav = document.getElementById('mainNav');

    mobileMenuBtn.addEventListener('click', () => {
        mainNav.classList.toggle('active');
    });
</script>

</body>
</html>
