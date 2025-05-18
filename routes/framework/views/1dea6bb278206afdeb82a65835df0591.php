<div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
    <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
        <?php if(request()->is('suppliers*') || request()->is('purchase_orders*') || request()->is('grns*')): ?>
            Procurement Center
        <?php elseif(request()->is('employees*')): ?>
            Employee Center
        <?php elseif(request()->is('inventory-center*')): ?>
            Inventory Center
        <?php elseif(request()->is('order-center*')): ?>
            Order Center
        <?php elseif(request()->is('delivery-center*')): ?>
            Delivery Center
        <?php elseif(request()->is('access-management-center*')): ?>
            Access Management Center
        <?php elseif(request()->is('contact-messages*') || request()->is('feedback*')): ?>
            Customer Communication
        <?php else: ?>
            Dashboard
        <?php endif; ?>
    </h1>
    <div style="display: flex; align-items: center; gap: 12px;">
        <a href="#" style="text-decoration: none; color: #000; font-size: 14px;">Logout</a>
        <div style="width: 40px; height: 40px; background-color: #E7592B; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <span class="material-icons" style="color: #fff; font-size: 20px;">person</span>
        </div>
    </div>
</div>
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\partials\admin\header.blade.php ENDPATH**/ ?>