<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flame & Crust Pizzeria</title>
    <style>
        :root {
            --primary-red: #d92525;
            --dark-red: #b31616;
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
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            font-size: 28px;
            color: var(--primary-red);
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
            color: var(--primary-red);
        }

        .page-banner {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            padding-top: 80px;
        }

        .page-banner h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .welcome-message {
            background: rgba(0,0,0,0.5);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 18px;
        }

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

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--primary-red);
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

            .page-banner h1 {
                font-size: 36px;
            }
        }


        /* Style for the logout button in the user dropdown menu */
.user-menu button {
    background-color: var(#6c757d);
    color: var(#1a1a1a);
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.user-menu button:hover {
    background-color: var(#6c757d);
    transform: scale(1.05);
}

.user-menu button:focus {
    outline: none;
}




    </style>
</head>
<body>

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
                <li><a href="<?php echo e(route('home')); ?>" <?php if(Request::routeIs('home')): ?> class="active" <?php endif; ?>>HOME</a></li>
                <li><a href="<?php echo e(route('menu')); ?>" <?php if(Request::routeIs('menu')): ?> class="active" <?php endif; ?>>MENU</a></li>
                <li><a href="<?php echo e(route('about')); ?>" <?php if(Request::routeIs('about')): ?> class="active" <?php endif; ?>>ABOUT US</a></li>
                <li><a href="<?php echo e(route('contact')); ?>" <?php if(Request::routeIs('contact')): ?> class="active" <?php endif; ?>>CONTACT US</a></li>

                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>">LOGIN</a></li>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <li class="user-dropdown">
                        <a href="#" id="userMenuBtn"><?php echo e(Auth::user()->name); ?> <i class="fas fa-caret-down"></i></a>
                        <ul class="user-menu" id="userMenu">
                            <li><a href="<?php echo e(route('profile')); ?>">Profile</a></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<div class="page-banner">
    <h1>Welcome to Flame & Crust Pizzeria</h1>

    <?php if(auth()->guard()->check()): ?>
        <div class="welcome-message">
            <p>Welcome, <?php echo e(Auth::user()->name); ?>!</p>
        </div>
    <?php endif; ?>
</div>
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


<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-about">
                <div class="footer-logo">
                    <h2>FLAME & CRUST</h2>
                    <span>PIZZARIA</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li><a href="<?php echo e(route('menu')); ?>">Menu</a></li>
                    <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
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
            <p>&copy; <?php echo e(date('Y')); ?> Flame & Crust Pizzeria. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script>
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mainNav = document.getElementById('mainNav');

    mobileMenuBtn.addEventListener('click', () => {
        mainNav.classList.toggle('active');
    });
</script>

</body>
</html>
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\homepage.blade.php ENDPATH**/ ?>