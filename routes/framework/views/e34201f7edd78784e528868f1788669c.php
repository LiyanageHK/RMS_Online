<?php $__env->startSection('title', 'Pending Order Allocation'); ?>

<?php $__env->startSection('content'); ?>
    <div style="padding: 20px;">
        <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
                Pending Order Allocation
            </h1>
        </div>

        <!-- Orders Table -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Address</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Phone</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order Value</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order Status</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->id); ?></td>
                        <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->address); ?></td>
                        <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->phone); ?></td>
                        <td style="padding: 12px; border: 1px solid #ddd;">Rs. <?php echo e(number_format($order->total, 2)); ?></td>
                        <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->order_status); ?></td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            <a href="<?php echo e(route('admin.driver.allocate', ['order_id' => $order->id])); ?>"
                               style="text-decoration: none; background-color: #E7592B; color: white; padding: 10px 20px; border-radius: 5px; display: inline-block; font-weight: bold;">
                                Allocate Driver
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="padding: 12px; border: 1px solid #ddd; text-align: center;">No orders available for delivery</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Action Buttons -->
        <br><br>
        <div style="display: flex; justify-content: space-between; gap: 12px;">
            <a href="<?php echo e(route('admin.driver.allocation.details')); ?>"
               style="text-decoration: none; background-color: #E7592B; color: white; padding: 12px 20px; border-radius: 5px; text-align: center; font-weight: bold;">
                Driver Allocation Details
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\pendingAllocation.blade.php ENDPATH**/ ?>