<?php $__env->startSection('content'); ?>
<div style="padding: 20px;">
    <h2>Customer Profile: <?php echo e($user->name); ?></h2>

    <br>
    <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
    <p><strong>Phone:</strong> <?php echo e($user->phone); ?></p>
    <p><strong>Address:</strong> <?php echo e($user->address); ?></p>
    <p><strong>Registered on:</strong> <?php echo e($user->created_at->format('Y-m-d')); ?></p>

        <br>
    <h3>Order History</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f4f4f4;">
            <tr style="text-align: center;">
                <th>Order Number</th>
                <th>Delivered Address</th>
                <th>Delivered Address Landmark</th>
                <th>Bill Amount</th>
                <th>Payment Method</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr style="text-align: center;">
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->address); ?></td>
                        <td><?php echo e($order->landmark); ?></td>
                        <td><?php echo e($order->total); ?></td>
                        <td><?php echo e($order->payment_status); ?></td>
                        <td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                    </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\customer\show.blade.php ENDPATH**/ ?>