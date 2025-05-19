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

        /* Page Banner */
        .page-banner {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            padding-top: 80px;
        }

        .page-banner h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        /* Menu Section */
        .menu {
            padding: 100px 0;
            background-color: var(--text-light);
            width: 100%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 42px;
            color: var(--primary-orange);
            margin-bottom: 20px;
        }

        .section-title p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 18px;
            color: #666;
        }

        .menu-categories {
            display: flex;
            justify-content: center;
            margin-bottom: 50px;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* New Filter Section Styles */
        .menu-filters {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
            padding: 0 20px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .filter-group label {
            font-weight: 600;
            color: var(--text-dark);
            margin-right: 5px;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
            color: var(--text-dark);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-select:hover {
            border-color: var(--primary-orange);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 2px rgba(231, 89, 43, 0.1);
        }

        .filter-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
            color: var(--text-dark);
            font-size: 14px;
            width: 100%;
            max-width: 300px;
            transition: all 0.3s;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 2px rgba(231, 89, 43, 0.1);
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .filter-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-orange);
            cursor: pointer;
        }

        .filter-checkbox span {
            font-size: 14px;
            color: var(--text-dark);
        }

        .category-btn {
            background: none;
            border: 2px solid var(--primary-orange);
            padding: 12px 25px;
            margin: 0 5px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 5px;
        }

        .category-btn.active {
            background-color: var(--primary-orange);
            color: var(--text-light);
        }

        .category-btn:hover {
            background-color: var(--primary-orange);
            color: var(--text-light);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(300px, 380px));
            gap: 30px;
            width: 100%;
            justify-content: center;
            padding: 0 20px;
        }

        .menu-item {
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            width: 100%;
            border: 1px solid #f0f0f0;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(231, 89, 43, 0.15);
        }

        .menu-item-img {
            width: 100%;
            height: 250px;
            overflow: hidden;
            position: relative;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .menu-item-img img {
            width: 85%;
            height: 85%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .menu-item:hover .menu-item-img img {
            transform: scale(1.08);
        }

        .menu-item-info {
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .menu-item-info h3 {
            font-size: 24px;
            color: #333;
            margin: 0;
            font-weight: 600;
        }

        .menu-item-info p {
            color: #666;
            font-size: 15px;
            line-height: 1.5;
            margin: 0;
        }

        /* Dietary and Spice Level Indicators */
        .item-indicators {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .dietary-indicator {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dietary-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .veg-dot {
            background-color: #4CAF50;
            border: 2px solid #4CAF50;
        }

        .non-veg-dot {
            background-color: #F44336;
            border: 2px solid #F44336;
        }

        .spice-level {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .chili-icon {
            color: #F44336;
            font-size: 14px;
        }

        .chili-icon.mild {
            opacity: 0.5;
        }

        .chili-icon.medium {
            opacity: 0.8;
        }

        .chili-icon.spicy {
            opacity: 1;
        }

        .pizza-sizes {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .size-button {
            background-color: transparent;
            color: #E7592B;
            border: 1px solid #E7592B;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            width: 100%;
        }

        .size-button:hover {
            background-color: #E7592B;
            color: white;
        }

        .size-label {
            display: block;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .size-price {
            font-weight: 600;
            font-size: 15px;
            text-align: center;
            margin-top: 5px;
        }

        .menu-item-bottom {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;
        }

        .customize-btn {
            background-color: #E7592B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            width: 100%;
        }

        .customize-btn:hover {
            background-color: #d64d1f;
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
        @media (max-width: 1200px) {
            .menu-grid {
                grid-template-columns: repeat(2, minmax(300px, 380px));
            }
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

            .container {
                padding: 0 30px;
            }

            .menu {
                padding: 60px 0;
            }

            .menu-grid {
                grid-template-columns: minmax(280px, 380px);
            }

            .menu-item {
                flex-direction: column;
            }

            .menu-item-img {
                height: 200px;
            }

            .menu-item-info {
                padding: 20px;
            }

            .menu-item-info h3 {
                font-size: 22px;
            }

            .pizza-sizes {
                gap: 10px;
            }
        }
    </style>



<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-banner">
        <div class="container">
            <h1>Our Pizza Menu</h1>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu">
        <div class="container">
            <div class="section-title">
                <h2>Flame & Crust Pizzas</h2>
                <p>Discover our artisanal pizzas made with the finest ingredients</p>
            </div>

            <!-- Filter Section -->
            <div class="menu-filters">
                <!-- Search Bar -->
                <div class="filter-group">
                    <label for="search">Search:</label>
                    <input type="text" id="search" class="filter-input" placeholder="Search here...">
                </div>
                <div class="filter-group">
                    <label for="price-sort">Sort by Price:</label>
                    <select class="filter-select" id="price-sort">
                        <option value="">Select</option>
                        <option value="low-high">Price: Low to High</option>
                        <option value="high-low">Price: High to Low</option>
                    </select>
                </div>
            </div>

            <!-- Category Buttons -->
            <div class="menu-categories">
                <button class="category-btn active" data-category="all">All Items</button>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="category-btn" data-category="<?php echo e(strtolower($category->name)); ?>">
                        <?php echo e($category->name); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="menu-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="menu-item" 
                         data-category="<?php echo e(strtolower($product->category_name)); ?>"
                         data-price="<?php echo e($product->small_price); ?>"
                         data-dietary="<?php echo e($product->name ? 'veg' : 'non-veg'); ?>"
                         data-spice-level="<?php echo e(strtolower($product->spice_level ?? '')); ?>"
                         data-name="<?php echo e(strtolower($product->name)); ?>"
                         data-description="<?php echo e(strtolower($product->description)); ?>">
                        <div class="menu-item-img">
                            <?php if($product->image): ?>
                                <img src="<?php echo e(asset('uploads/products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/default-product.jpg')); ?>" alt="<?php echo e($product->name); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="menu-item-info">
                            <h3><?php echo e($product->name); ?></h3>
                            <p><?php echo e($product->description); ?></p>

                            <div class="pizza-sizes">
                                <button class="size-button" data-size="small" data-price="<?php echo e($product->small_price); ?>">
                                    <div class="size-label">Small</div>
                                    <div class="size-price">Rs.<br><?php echo e(number_format($product->small_price, 2)); ?></div>
                                </button>
                                <button class="size-button" data-size="medium" data-price="<?php echo e($product->medium_price); ?>">
                                    <div class="size-label">Medium</div>
                                    <div class="size-price">Rs.<br><?php echo e(number_format($product->medium_price, 2)); ?></div>
                                </button>
                                <button class="size-button" data-size="large" data-price="<?php echo e($product->large_price); ?>">
                                    <div class="size-label">Large</div>
                                    <div class="size-price">Rs.<br><?php echo e(number_format($product->large_price, 2)); ?></div>
                                </button>
                            </div>

                            <div class="menu-item-bottom">
                                <button class="customize-btn">Customize</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        // Menu Category Filter with Search
        const categoryBtns = document.querySelectorAll('.category-btn');
        const menuItems = document.querySelectorAll('.menu-item');
        const searchInput = document.getElementById('search');

        let activeCategory = 'all'; // Default category

        // Category Filter Logic
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryBtns.forEach(btn => btn.classList.remove('active'));
                btn.classList.add('active');

                activeCategory = btn.dataset.category; // Update active category
                filterMenuItems();
            });
        });

        // Search Functionality
        searchInput.addEventListener('input', () => {
            filterMenuItems();
        });

        // Filter Menu Items Based on Category and Search
        function filterMenuItems() {
            const searchValue = searchInput.value.toLowerCase();
            let itemsFound = false; // Track if any items match the filters

            menuItems.forEach(item => {
                const itemCategory = item.dataset.category;
                const itemName = item.dataset.name;
                const itemDescription = item.dataset.description;

                const matchesCategory = activeCategory === 'all' || itemCategory === activeCategory;
                const matchesSearch = itemName.includes(searchValue) || itemDescription.includes(searchValue);

                if (matchesCategory && matchesSearch) {
                    item.style.display = 'flex';
                    itemsFound = true; // At least one item matches
                } else {
                    item.style.display = 'none';
                }
            });

            // Display 'No items found' message if no items match
            const noItemsMessage = document.getElementById('no-items-message');
            if (!itemsFound) {
                if (!noItemsMessage) {
                    const message = document.createElement('div');
                    message.id = 'no-items-message';
                    message.textContent = 'No items found';
                    message.style.textAlign = 'center';
                    message.style.marginTop = '20px';
                    message.style.color = '#666';
                    message.style.fontSize = '18px';
                    document.querySelector('.menu-grid').appendChild(message);
                }
            } else {
                if (noItemsMessage) {
                    noItemsMessage.remove();
                }
            }
        }

        // Size Selection
        const sizeButtons = document.querySelectorAll('.size-button');
        
        sizeButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all size buttons in the same pizza item
                const parentItem = button.closest('.menu-item');
                parentItem.querySelectorAll('.size-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Add active class to clicked button
                button.classList.add('active');
            });
        });

        // Price Sorting
        const priceSortSelect = document.getElementById('price-sort');

        priceSortSelect.addEventListener('change', () => {
            const sortOrder = priceSortSelect.value;
            const menuGrid = document.querySelector('.menu-grid');
            const menuItemsArray = Array.from(menuItems);

            if (sortOrder) {
                const sortedItems = menuItemsArray.sort((a, b) => {
                    const priceA = parseFloat(a.dataset.price);
                    const priceB = parseFloat(b.dataset.price);

                    return sortOrder === 'low-high' ? priceA - priceB : priceB - priceA;
                });

                sortedItems.forEach(item => menuGrid.appendChild(item));
            } else {
                // Reset to original order if no sorting is selected
                menuItemsArray.forEach(item => menuGrid.appendChild(item));
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appclient', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views/menu.blade.php ENDPATH**/ ?>