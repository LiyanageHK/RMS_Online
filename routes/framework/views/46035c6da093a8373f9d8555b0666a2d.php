<div style="width: 250px; background-color: #ffffff; color: #333; padding: 20px; box-shadow: 2px 0px 8px rgba(0, 0, 0, 0.05); display: flex; flex-direction: column;">
    <!-- Logo -->
    <div style="text-align: center; margin-bottom: 25px;">
        <img src="<?php echo e(asset('images/Logo.svg')); ?>" alt="Logo" style="width: 80px;">
        <div style="margin-top: 10px;">
            <div style="font-size: 22px; color: #E7592B; font-family: 'Castoro Titling'; font-weight: bold;">FLAME & CRUST</div>
            <div style="font-size: 14px; color: #888; font-family: 'Gloock';">PIZZERIA</div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div id="sidebarMenu" style="flex-grow: 1;">
        <button class="sidebar-btn <?php echo e(request()->is('dashboard*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">dashboard</span> Dashboard</span>
        </button>

        <button class="sidebar-btn <?php echo e(request()->is('inventory*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">inventory</span> Inventory Center</span>
        </button>

        <!-- Procurement Center -->
        <?php
            $procurementExpanded = request()->is('suppliers*') || request()->is('purchase_orders*') || request()->is('grns*');
        ?>
        <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">business</span> Procurement Center</span>
                <span class="material-icons toggle-icon"><?php echo e($procurementExpanded ? 'expand_less' : 'expand_more'); ?></span>
            </button>
            <div class="submenu" style="display: <?php echo e($procurementExpanded ? 'block' : 'none'); ?>; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="<?php echo e(route('suppliers.index')); ?>" class="submenu-link <?php echo e(request()->is('suppliers*') ? 'active' : ''); ?>">Suppliers</a>
                <a href="<?php echo e(route('purchase_orders.index')); ?>" class="submenu-link <?php echo e(request()->is('purchase_orders*') ? 'active' : ''); ?>">Purchase Orders</a>
                <a href="<?php echo e(route('grns.index')); ?>" class="submenu-link <?php echo e(request()->is('grns*') ? 'active' : ''); ?>">Good Received Notes</a>
            </div>
        </div>

        <button class="sidebar-btn <?php echo e(request()->is('customers*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">group</span> Customer Center</span>
        </button>

        <button class="sidebar-btn <?php echo e(request()->is('orders*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">shopping_cart</span> Order Center</span>
        </button>

        <button class="sidebar-btn <?php echo e(request()->is('delivery*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">local_shipping</span> Delivery Center</span>
        </button>

        <!-- ✅ Employee Center -->
        <a href="<?php echo e(route('employees.index')); ?>" class="sidebar-btn anchor-btn <?php echo e(request()->is('employees*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">people</span> Employee Center</span>
        </a>

        <button class="sidebar-btn <?php echo e(request()->is('access-management*') ? 'active' : ''); ?>">
            <span class="btn-content"><span class="material-icons">security</span> Access Management Center</span>
        </button>

        <!-- Customer Communication -->
        <?php
            $communicationExpanded = request()->is('contact*') || request()->is('feedback*');
        ?>
        <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">chat</span> Customer Communication</span>
                <span class="material-icons toggle-icon"><?php echo e($communicationExpanded ? 'expand_less' : 'expand_more'); ?></span>
            </button>
            <div class="submenu" style="display: <?php echo e($communicationExpanded ? 'block' : 'none'); ?>; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="<?php echo e(route('contact.index')); ?>" class="submenu-link <?php echo e(request()->is('contact*') ? 'active' : ''); ?>">Contact Us</a>
                <a href="<?php echo e(route('feedback.index')); ?>" class="submenu-link <?php echo e(request()->is('feedback*') ? 'active' : ''); ?>">Feedback</a>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar Styling -->
<style>
    .sidebar-btn,
    .anchor-btn {
        background-color: #f8f8f8;
        color: #333;
        font-size: 15px;
        padding: 12px 16px;
        width: 100%;
        border: none;
        border-radius: 6px;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
        text-decoration: none;
    }

    .sidebar-btn:hover,
    .anchor-btn:hover {
        background-color: #eee;
    }

    .sidebar-btn.active,
    .anchor-btn.active {
        background-color: #E7592B;
        color: white;
    }

    .btn-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .material-icons {
        font-size: 20px;
    }

    .submenu-link {
        display: block;
        padding: 8px 12px;
        border-radius: 4px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .submenu-link.active,
    .submenu-link:hover {
        background-color: #E7592B;
        color: white;
    }

    .toggle-icon {
        margin-left: auto;
    }
</style>
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\partials\admin\sidebar.blade.php ENDPATH**/ ?>