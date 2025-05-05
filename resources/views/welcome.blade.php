    @extends('layouts.appclient')
   
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
            color: var(--primary-red);
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
            color: var(--primary-red);
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
            color: var(--primary-red);
        }

        .pizza-info p {
            margin-bottom: 15px;
            color: #666;
        }

        .price {
            font-weight: 700;
            color: var(--primary-red);
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



@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>EXPERIENCE ITALIAN CULINARY EXCELLENCE</h2>
                <p>Discover the Art of Authentic Italian Pizza!</p>
                <p>Indulge in our handcrafted pizzas, made with the finest ingredients and perfected through generations of Italian tradition. Every slice is a celebration of authentic flavors and culinary craftsmanship.</p>
                <a href="{{ route('menu') }}" class="btn">ORDER NOW</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us" style="padding: 80px 0; background-color: #f8f8f8;">
        <div class="container">
            <div class="section-title" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; color: #333; margin-bottom: 20px;">Why Choose Flame & Crust?</h2>
                <p style="color: #666; max-width: 800px; margin: 0 auto;">Experience the perfect blend of traditional Italian craftsmanship and modern flavors</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div style="text-align: center; padding: 30px;">
                    <i class="fas fa-fire" style="font-size: 3rem; color: #E7592B; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Wood-Fired Oven</h3>
                    <p style="color: #666;">Traditional wood-fired cooking for authentic flavor and perfect crust</p>
                </div>
                <div style="text-align: center; padding: 30px;">
                    <i class="fas fa-leaf" style="font-size: 3rem; color: #E7592B; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Fresh Ingredients</h3>
                    <p style="color: #666;">Locally sourced, premium ingredients for the best quality pizzas</p>
                </div>
                <div style="text-align: center; padding: 30px;">
                    <i class="fas fa-clock" style="font-size: 3rem; color: #E7592B; margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Fast Delivery</h3>
                    <p style="color: #666;">Quick and reliable delivery to your doorstep while still hot</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Items Section -->
    <section class="featured-items" style="padding: 80px 0; background-color: #1a1a1a;">
        <div class="container">
            <div class="featured-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <!-- Pizza Item 1 -->
                <div class="featured-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="https://images.unsplash.com/photo-1593560708920-61dd98c46a4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                         alt="Pizza Margherita" 
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);"></div>
                </div>

                <!-- Pizza Item with Menu Button -->
                <div class="featured-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="{{ asset('uploads/products/Pizza Napoletana.png') }}" 
                         alt="Pizza" 
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; width: 100%;">
                            <h2 style="color: white; font-size: 2.5rem; margin-bottom: 20px;">CHECK MENU</h2>
                            <a href="{{ route('menu') }}" class="menu-btn" style="
                                display: inline-block;
                                padding: 12px 30px;
                                background-color: #E7592B;
                                color: white;
                                text-decoration: none;
                                border-radius: 5px;
                                font-weight: bold;
                                text-transform: uppercase;
                                transition: background-color 0.3s;">MENU</a>
                        </div>
                    </div>
                </div>

                <!-- Pizza Item 2 -->
                <div class="featured-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                    <img src="https://images.unsplash.com/photo-1571407970349-bc81e7e96d47?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                         alt="Pepperoni Pizza" 
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pizza Sizes -->
    <section class="pizza-sizes">
        <div class="container">
            <div class="section-title">
                <h2>Choose Your Size</h2>
                <p>Perfect pizzas for every appetite</p>
            </div>
            <div class="sizes-container">
                <div class="size-item">
                    <h3 class="size-title">LARGE PIZZA</h3>
                    <p class="size-subtitle">13 Inches Diameter</p>
                    <div class="pizza-image large">
                        <img src="{{ asset('uploads/products/Pizza Napoletana.png') }}" alt="Large Pizza">
                    </div>
                </div>
                <div class="size-item">
                    <h3 class="size-title">MEDIUM PIZZA</h3>
                    <p class="size-subtitle">10 Inches Diameter</p>
                    <div class="pizza-image medium">
                        <img src="{{ asset('uploads/products/Pizza Napoletana.png') }}" alt="Medium Pizza">
                    </div>
                </div>
                <div class="size-item">
                    <h3 class="size-title">SMALL PIZZA</h3>
                    <p class="size-subtitle">7 Inches Diameter</p>
                    <div class="pizza-image small">
                        <img src="{{ asset('uploads/products/Pizza Napoletana.png') }}" alt="Small Pizza">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Order Section -->
    <section class="order-process" style="padding: 80px 0; background-color: #1a1a1a; color: white;">
        <div class="container">
            <div class="section-title" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; margin-bottom: 20px;">How to Order</h2>
                <p style="color: #ccc; max-width: 800px; margin: 0 auto;">Getting your favorite pizza is just 4 steps away</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
                <div style="text-align: center; padding: 20px;">
                    <div style="width: 60px; height: 60px; background-color: #E7592B; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span style="font-size: 1.5rem; font-weight: bold;">1</span>
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px;">Choose Your Pizza</h3>
                    <p style="color: #ccc;">Select from our wide range of delicious pizzas</p>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <div style="width: 60px; height: 60px; background-color: #E7592B; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span style="font-size: 1.5rem; font-weight: bold;">2</span>
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px;">Customize</h3>
                    <p style="color: #ccc;">Add your favorite toppings and choose your crust</p>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <div style="width: 60px; height: 60px; background-color: #E7592B; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span style="font-size: 1.5rem; font-weight: bold;">3</span>
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px;">Place Order</h3>
                    <p style="color: #ccc;">Confirm your order and proceed to payment</p>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <div style="width: 60px; height: 60px; background-color: #E7592B; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span style="font-size: 1.5rem; font-weight: bold;">4</span>
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 15px;">Enjoy!</h3>
                    <p style="color: #ccc;">Receive your hot, fresh pizza at your doorstep</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery Information Section -->
    <section style="padding: 80px 0; background-color: var(--light-bg);">
        <div class="container">
            <div class="section-title" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; color: #333; margin-bottom: 20px;">Delivery Service</h2>
                <p style="color: #666; max-width: 800px; margin: 0 auto;">Serving you with excellence and care</p>
            </div>
            
            <!-- Delivery Features -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-bottom: 50px;">
                <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--primary-red); margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Delivery Areas</h3>
                    <ul style="list-style: none; padding: 0; color: #666;">
                        <li style="margin-bottom: 10px;">Colombo (All Areas)</li>
                        <li style="margin-bottom: 10px;">Dehiwala-Mount Lavinia</li>
                        <li style="margin-bottom: 10px;">Sri Jayawardenepura Kotte</li>
                        <li style="margin-bottom: 10px;">Nugegoda</li>
                    </ul>
                </div>
                
                <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-clock" style="font-size: 2.5rem; color: var(--primary-red); margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Operating Hours</h3>
                    <ul style="list-style: none; padding: 0; color: #666;">
                        <li style="margin-bottom: 10px;">Open Daily</li>
                        <li style="margin-bottom: 10px;">11:00 AM - 11:00 PM</li>
                        <li>7 Days a Week</li>
                    </ul>
                </div>
                
                <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <i class="fas fa-heart" style="font-size: 2.5rem; color: var(--primary-red); margin-bottom: 20px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Our Promise</h3>
                    <ul style="list-style: none; padding: 0; color: #666;">
                        <li style="margin-bottom: 10px;">Fast & Reliable Service</li>
                        <li style="margin-bottom: 10px;">Professional Delivery Team</li>
                        <li style="margin-bottom: 10px;">Careful Handling</li>
                        <li>Customer Satisfaction Priority</li>
                    </ul>
                </div>
            </div>

            <!-- Service Highlight -->
            <div style="background: var(--primary-red); padding: 40px; border-radius: 15px; text-align: center; color: white;">
                <i class="fas fa-award" style="font-size: 3rem; margin-bottom: 20px;"></i>
                <h3 style="font-size: 2rem; margin-bottom: 15px;">Exceptional Service</h3>
                <p style="font-size: 1.2rem;">We take pride in delivering not just great food, but also great service to ensure your complete satisfaction.</p>
            </div>
        </div>
    </section>

    <!-- Loyalty Program Section -->
    <section style="padding: 80px 0; background-color: white;">
        <div class="container">
            <div class="section-title" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; color: #333; margin-bottom: 20px;">Loyalty Rewards Program</h2>
                <p style="color: #666; max-width: 800px; margin: 0 auto;">Get rewarded for your love of pizza!</p>
            </div>

            <!-- Program Features -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 50px;">
                <!-- How to Join -->
                <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="width: 70px; height: 70px; background-color: var(--primary-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-user-plus" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px; color: var(--primary-red);">How to Join</h3>
                    <p style="color: #666; margin-bottom: 15px;">Order with us 3 times and automatically become a loyalty member!</p>
                    <p style="color: #666;">Start earning points from your very first order as a member.</p>
                </div>

                <!-- Earn Points -->
                <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="width: 70px; height: 70px; background-color: var(--primary-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-coins" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px; color: var(--primary-red);">Earn Points</h3>
                    <p style="color: #666; margin-bottom: 15px;">Earn 1 point for every Rs. 100 spent</p>
                    <div style="background: #f8f8f8; padding: 15px; border-radius: 10px; margin-top: 15px;">
                        <p style="color: #666; font-style: italic;">Example: Rs. 1,500 order = 15 Points</p>
                    </div>
                </div>

                <!-- Redeem Points -->
                <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="width: 70px; height: 70px; background-color: var(--primary-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-gift" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px; color: var(--primary-red);">Redeem Rewards</h3>
                    <p style="color: #666; margin-bottom: 15px;">1 Point = Rs. 1 discount on your next order</p>
                    <div style="background: #f8f8f8; padding: 15px; border-radius: 10px; margin-top: 15px;">
                        <p style="color: #666; font-style: italic;">Example: 50 Points = Rs. 50 discount</p>
                    </div>
                </div>
            </div>

            <!-- Join Now Banner -->
            <div style="background: linear-gradient(45deg, var(--primary-red), #ff6b6b); padding: 40px; border-radius: 15px; text-align: center; color: white;">
                <i class="fas fa-star" style="font-size: 3rem; margin-bottom: 20px;"></i>
                <h3 style="font-size: 2rem; margin-bottom: 15px;">Start Earning Today!</h3>
                <p style="font-size: 1.2rem; margin-bottom: 20px;">Join our loyalty program and turn your pizza passion into rewards.</p>
                <a href="{{ route('menu') }}" style="display: inline-block; background: white; color: var(--primary-red); padding: 12px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: transform 0.3s;">Order Now</a>
            </div>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section class="customer-reviews" style="padding: 80px 0; background-color: #f8f8f8;">
        <div class="container">
            <div class="section-title" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; color: #333; margin-bottom: 20px;">What Our Customers Say</h2>
                <p style="color: #666; max-width: 800px; margin: 0 auto;">Real reviews from our valued customers</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="color: #E7592B; margin-bottom: 15px;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p style="color: #666; margin-bottom: 20px;">"The best pizza I've ever had! The crust is perfectly crispy and the toppings are always fresh. Highly recommended!"</p>
                    <div style="color: #333; font-weight: bold;">Sarah M.</div>
                </div>
                <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="color: #E7592B; margin-bottom: 15px;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p style="color: #666; margin-bottom: 20px;">"Fast delivery and amazing taste! Their wood-fired pizzas have a unique flavor that keeps me coming back for more."</p>
                    <div style="color: #333; font-weight: bold;">John D.</div>
                </div>
                <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="color: #E7592B; margin-bottom: 15px;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p style="color: #666; margin-bottom: 20px;">"Great variety of toppings and excellent customer service. The online ordering system is very convenient!"</p>
                    <div style="color: #333; font-weight: bold;">Michael R.</div>
                </div>
            </div>
        </div>
    </section>

    @endsection

    