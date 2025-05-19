<style>
    header {
        width: 100vw;
        background: #000;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        padding: 10px 0; /* Reduced padding to make the header thinner */
    }
    .header-container {
        max-width: 100%; /* or your preferred max width */
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 40px; /* Adjusted padding for inner content */
    }
    nav ul li a {
        color: #fff; /* Set link color to white */
        text-decoration: none;
    }
    nav ul li a:hover {
        color: #E7592B; /* Change color to orange on hover */
    }
    nav ul li a.active {
        color: #E7592B; /* Ensure active state is orange */
    }
</style>
<header>
    <div class="header-container">
        <div class="logo" style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('uploads/logo/logo2.png') }}" alt="Flame & Crust Pizzeria Logo" style="width: 80px; height: auto;">
            <h1 style="color: #E7592B; font-size: 1.5rem; margin: 0;">FLAME & CRUST PIZZERIA</h1>
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
                <li>
                    <a href="{{ route('cartview') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-shopping-cart"></i>
                        <span style="margin-left: 6px;">CART</span>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span style="background: #E7592B; color: #fff; border-radius: 50%; padding: 2px 8px; font-size: 0.85rem; margin-left: 5px;">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                </li>
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
</header>



<style>
    @media (max-width: 900px) {
        .header-container {
            flex-direction: column;
            align-items: flex-start;
            padding: 0 15px;
        }
        nav ul {
            flex-direction: column;
            gap: 0;
            width: 100%;
            background: #000;
            position: absolute;
            top: 60px;
            left: 0;
            display: none;
        }
        nav ul.active {
            display: flex !important;
        }
        .mobile-menu-btn {
            display: block !important;
        }
    }
    .user-dropdown:hover .user-menu,
    .user-dropdown:focus-within .user-menu {
        display: block !important;
    }
</style>
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
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
