<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Link to the login CSS file -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
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
                        <!-- User menu with name -->
                    @else
                        <li><a href="{{ route('login') }}">LOGIN</a></li>
                    @endauth


                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Login</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>




            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" required>
                <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
            </div>


            <button type="submit">Login</button>
        </form>

        <br><br>
        <!-- Register Link -->
        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>

         <!-- Admin Question -->
        <p>Are you an Admin?</p>
    </div>




















    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <div class="footer-logo">
                        <h2>FLAME & CRUST</h2>
                        <span>PIZZARIA</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                        <li><i class="fas fa-map-marker-alt"></i> 123 Pizza Street</li>
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
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mainNav = document.getElementById('mainNav');

        mobileMenuBtn.addEventListener('click', () => {
            mainNav.classList.toggle('active');
        });

        const navLinks = document.querySelectorAll('nav ul li a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('active');
            });
        });
    </script>
</body>
</html>
