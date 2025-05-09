<style>
    :root {
        --primary-orange: #E7592B;
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
        background-color: black; /* Header background color */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        width: 100%;
        z-index: 1000;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo h1 {
        font-size: 28px;
        color: #E7592B; /* Company name color */
        margin-right: 10px;
    }

    .logo span {
        font-size: 28px; /* Match font size with company name */
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: #E7592B; /* Same color as company name */
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
        color: white; /* Header letters white */
        font-weight: 500;
        transition: color 0.3s;
    }

    nav ul li a.active, /* Highlight clicked heading */
    nav ul li a:hover {
        color: #E7592B; /* Clicked heading color */
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
    }
</style>

<header>
    <div class="container header-container">
        <div class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Flame & Crust Pizzeria Logo" style="width: 100px; height: auto;">
            <h1>FLAME & CRUST PIZZERIA</h1>
        </div>
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
        <nav id="mainNav">
            <ul>
                <li><a href="{{ route('client.home') }}" @if(Request::routeIs('client.home')) class="active" @endif>HOME</a></li>
                <li><a href="{{ route('client.menu') }}" @if(Request::routeIs('client.menu')) class="active" @endif>MENU</a></li>
                <li><a href="{{ route('client.about') }}" @if(Request::routeIs('client.about')) class="active" @endif>ABOUT US</a></li>
                <li><a href="{{ route('client.contact') }}" @if(Request::routeIs('client.contact')) class="active" @endif>CONTACT US</a></li>
                <li><a href="#">LOGIN</a></li>
                @auth
                    <li><a href="{{ route('dashboard') }}">DASHBOARD</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

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
