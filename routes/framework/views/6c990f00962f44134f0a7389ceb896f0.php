<style>
    :root {
            --primary-red: #E7592B;
            --dark-red: #E7592B;
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
            color: var(--primary-red);
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
            background-color: var(--primary-red);
            color: var(--text-light);
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--dark-red);
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

    .fadeInElement {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .fadeIn {
        opacity: 1;
        transform: translateY(0);
    }

    img {
        opacity: 1;
    }

    /* Footer Styles */
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
            color: var(--primary-red);
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

<?php $__env->startSection('title', 'About Us'); ?>

<?php $__env->startSection('content'); ?>



<section style="position: relative; padding: 160px 20px 120px; color: white; text-align: center; background: url('<?php echo e(asset('images/bg-texture.jpg')); ?>') center/cover no-repeat;">
    <div style="position: absolute; inset: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
    
    <div style="position: relative; z-index: 2;">
        <h1 style="font-size: 58px; font-weight: 800; color: #E7592B; letter-spacing: 2px;">About Us</h1>
        <p style="font-size: 22px; font-weight: 300; margin-top: 10px; line-height: 1.6;">Where crust meets passion, and flavor fires up your day.</p>
    </div>
</section>


<section style="background-color: #fff; padding: 100px 20px;">
    <div class="container" style="display: flex; justify-content: space-between; gap: 40px; align-items: center;">
        <div style="flex: 1; min-width: 300px; position: relative;" class="story-image fadeInElement">
            <img src="<?php echo e(asset('images/Pizza.jpg')); ?>" alt="Our Story" style="width: 100%; border-radius: 20px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15); transition: transform 0.3s ease;">
            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-weight: 600; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Our Journey, Your Flavor</div>
        </div>
        <div style="flex: 1; min-width: 300px;">
            <h2 style="color: #E7592B; font-size: 40px; font-weight: 700; margin-bottom: 30px;">Our Story</h2>
            <p style="font-size: 18px; color: #444; line-height: 1.8; font-weight: 300;">Flame & Crust Pizzeria was born from a love of authentic, oven-fired pizzas. From humble beginnings to a community favorite, we’ve always believed in serving honest food, made fresh, and delivered fast. Our story is one of passion, growth, and flavor.</p>
        </div>
    </div>
</section>


<section style="background-color: #f9f9f9; padding: 100px 20px;">
    <div class="container" style="display: flex; justify-content: space-between; gap: 40px; align-items: center;">
        <div style="flex: 1; min-width: 300px;">
            <h2 style="color: #E7592B; font-size: 40px; font-weight: 700; margin-bottom: 30px;">Our Mission</h2>
            <p style="font-size: 18px; color: #444; line-height: 1.8; font-weight: 300;">Our mission is to redefine pizza delivery with fast, fresh, and flavorful pies. We blend tradition with technology to ensure every order is crafted with care and delivered with excellence. Fast, fresh, and full of flavor — that’s what we promise!</p>
        </div>
        <div style="flex: 1; min-width: 300px; position: relative;" class="mission-image fadeInElement">
            <img src="<?php echo e(asset('images/mission.webp')); ?>" alt="Our Mission" style="width: 100%; border-radius: 20px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);">
            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-weight: 600; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Pizza with Purpose</div>
        </div>
    </div>
</section>


<section style="background-color: #fff; padding: 100px 20px;">
    <div class="container" style="max-width: 900px; margin: 0 auto; text-align: center;">
        <h2 style="color: #E7592B; font-size: 40px; font-weight: 700; margin-bottom: 40px;">Our Core Values</h2>
        <ul style="font-size: 20px; color: #444; line-height: 2.4; text-align: left; padding-left: 30px;">
            <li style="margin-bottom: 20px;"><strong> Quality</strong> – We use only the freshest, highest-quality ingredients, ensuring every slice is a masterpiece.</li>
            <li style="margin-bottom: 20px;"><strong> Customer Satisfaction</strong> – Your happiness is our priority, every slice, every time. We aim to exceed your expectations.</li>
            <li style="margin-bottom: 20px;"><strong> Innovation</strong> – We’re constantly exploring bold new flavors and smarter ways to deliver your pizza faster.</li>
            <li style="margin-bottom: 20px;"><strong> Integrity</strong> – We do business the right way, with honesty and heart. Trust is key to our recipe.</li>
        </ul>
    </div>
</section>


<section style="background-color: #E7592B; color: white; padding: 80px 20px; text-align: center;">
    <div class="container">
        <h2 style="font-size: 42px; font-weight: 700; margin-bottom: 20px;">Still Have Questions?</h2>
        <p style="font-size: 18px; font-weight: 300; margin-bottom: 40px;">Reach out — we’re happy to assist you with anything!</p>
        <a href="<?php echo e(route('contact')); ?>" style="padding: 14px 40px; background-color: black; color: white; font-size: 18px; font-weight: 600; border-radius: 40px; text-decoration: none; transition: background-color 0.3s;">
            Contact Us Now
        </a>
    </div>
</section>


<script>
    const fadeInElements = document.querySelectorAll('.fadeInElement');

    const fadeInOnScroll = (element) => {
        const rect = element.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom >= 0) {
            element.classList.add('fadeIn');
        }
    };

    window.addEventListener('scroll', () => {
        fadeInElements.forEach(element => fadeInOnScroll(element));
    });

    // Adding hover effect on images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.05)';
            img.style.transition = 'transform 0.3s ease';
        });
        img.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
        });
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appclient', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\client\about.blade.php ENDPATH**/ ?>