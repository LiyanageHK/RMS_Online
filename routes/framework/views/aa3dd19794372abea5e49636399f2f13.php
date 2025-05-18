<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flame & Crust - <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/client.css')); ?>">
<script src="<?php echo e(asset('js/client.js')); ?>" defer></script>

</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <?php echo $__env->make('partials.client.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main style="flex: 1;">
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->yieldContent('scripts'); ?>
    </main>

    <?php echo $__env->make('partials.client.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html>
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\layouts\client.blade.php ENDPATH**/ ?>