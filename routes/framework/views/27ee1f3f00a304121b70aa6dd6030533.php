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
<header class="header-container">
    <div class="container header-container">
        <div class="logo">
            <img src="<?php echo e(asset('uploads/logo/logo2.png')); ?>" alt="Flame & Crust Pizzeria Logo" class="logo" style="width: 100px; height: auto;">
            <h1>FLAME & CRUST PIZZERIA</h1>
        </div>
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
        <nav id="mainNav">
            <ul>


                <li><a href="<?php echo e(route('welcome')); ?>" <?php if(Request::routeIs('welcome')): ?> class="active" <?php endif; ?>>HOME</a></li>
                <li><a href="<?php echo e(route('menu')); ?>" <?php if(Request::routeIs('menu')): ?> class="active" <?php endif; ?>>MENU</a></li>
                <li><a href="<?php echo e(route('about')); ?>" <?php if(Request::routeIs('about')): ?> class="active" <?php endif; ?>>ABOUT US</a></li>
                <li><a href="<?php echo e(route('contact')); ?>" <?php if(Request::routeIs('contact')): ?> class="active" <?php endif; ?>>CONTACT US</a></li>

                <li><a href="<?php echo e(route('login')); ?>">LOGIN</a></li>
            </ul>
        </nav>
    </div>
</header>

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
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\partials\header.blade.php ENDPATH**/ ?>