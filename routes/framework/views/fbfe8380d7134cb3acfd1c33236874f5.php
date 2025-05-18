<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Link to the register CSS file -->
    <link rel="stylesheet" href="<?php echo e(asset('css/register.css')); ?>">
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

                    <li><a href="<?php echo e(route('home')); ?>" <?php if(Request::routeIs('home')): ?> class="active" <?php endif; ?>>HOME</a></li>
                    <li><a href="<?php echo e(route('menu')); ?>" <?php if(Request::routeIs('menu')): ?> class="active" <?php endif; ?>>MENU</a></li>
                    <li><a href="<?php echo e(route('about')); ?>" <?php if(Request::routeIs('about')): ?> class="active" <?php endif; ?>>ABOUT US</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>" <?php if(Request::routeIs('contact')): ?> class="active" <?php endif; ?>>CONTACT US</a></li>
                    <li><a href="<?php echo e(route('login')); ?>">LOGIN</a></li>

                    


                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Register</h1>

        <!-- Display Validation Errors -->
        <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>

        <!-- Display Session Messages -->
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?> " required>

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?> " required>

            <!-- Phone -->
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?> " required>

            <!-- Address -->
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="<?php echo e(old('address')); ?> " required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <button type="submit">Register</button>
        </form>

        <br><br>
        <!-- Login Link -->
        <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Login here</a></p>
    </div>

    <div class="image-box">
        <img src="<?php echo e(asset('images/pizzaimage.png')); ?>" alt="Pizza Image">
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

    <!-- Link to the register JS file -->
    <script src="<?php echo e(asset('js/register.js')); ?>"></script>

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
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\register.blade.php ENDPATH**/ ?>