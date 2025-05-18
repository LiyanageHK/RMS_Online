<?php $__env->startSection('title', 'Dispatched Orders'); ?>

<?php $__env->startSection('content'); ?>
<div style="padding: 20px;">
    <h1 style="font-weight: bold;">Dispatched Orders</h1>




    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Order ID</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Name</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Address</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Landmark</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Phone</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Total</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Payment Status</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Order Status</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->id); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->name); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->address); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->landmark ?? '-'); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->phone); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;">Rs. <?php echo e(number_format($order->total, 2)); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->payment_status); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?php echo e($order->order_status); ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        <form method="POST" action="<?php echo e(route('admin.driver.orders.markDelivered', $order->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to mark this order as Delivered?')"
                                style="background-color: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                                Delivered
                            </button>
                        </form>



                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                        No dispatched orders available.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\deliveryConfirmation.blade.php ENDPATH**/ ?>