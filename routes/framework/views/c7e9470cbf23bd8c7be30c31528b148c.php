
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders - Flame & Crust</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">



    <style>
        .order-history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 6px;
            overflow: hidden;
        }

        .order-history-table th,
        .order-history-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .order-history-table th {
            background-color: #f5f5f5;
            font-weight: 600;
            color: #333;
        }

        .order-history-table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .order-history-table tbody tr:hover {
            background-color: #f0f8ff;
            transition: background-color 0.3s ease;
        }

        .order-history-table td {
            color: #555;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff5722;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e64a19;
        }
    </style>



</head>
<body>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container">
    <h2>Your Order History</h2>

    <?php if($orders->isEmpty()): ?>
        <p>You have no orders yet.</p>
    <?php else: ?>
        <table class="order-history-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Address</th>
                    <th>Landmark</th>
                    <th>Phone</th>
                    <th>Total (LKR)</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Ordered At</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($order->address); ?></td>
                        <td><?php echo e($order->landmark ?? 'N/A'); ?></td>
                        <td><?php echo e($order->phone); ?></td>
                        <td><?php echo e(number_format($order->total, 2)); ?></td>
                        <td><?php echo e($order->payment_status); ?></td>
                        <td><?php echo e($order->order_status); ?></td>
                        <td><?php echo e($order->created_at->format('d M Y h:i A')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br>
    <a href="<?php echo e(url('/profile')); ?>" class="btn">← Back to Profile</a>
</div>

<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html>




<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\profile_orderdetails.blade.php ENDPATH**/ ?>