<?php $__env->startSection('content'); ?>
    <div class="allocation-container">

        <div class="header">
            <h1>Allocate Driver for Order #<?php echo e($order->id); ?></h1>
        </div>



        <?php if($errors->any()): ?>
            <div class="alert error">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.driver.storeAllocation')); ?>" method="POST" class="allocation-form" id="allocationForm">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
            <input type="hidden" name="address" value="<?php echo e($delivery->address ?? $order->address); ?>">
            <input type="hidden" name="landmark" value="<?php echo e($delivery->landmark ?? ''); ?>">
            <input type="hidden" name="phone" value="<?php echo e($delivery->phone ?? $order->phone); ?>">
            <input type="hidden" name="total" value="<?php echo e($delivery->total ?? $order->total); ?>">


            <div class="form-group">
                <label>Address:</label>
                <input type="text" value="<?php echo e($delivery->address ?? $order->address); ?>" readonly class="input-field">
            </div>

            <div class="form-group">
                <label>Landmark:</label>
                <input type="text" value="<?php echo e($delivery->landmark ?? 'Not specified'); ?>" readonly class="input-field">
            </div>

            <div class="form-group">
                <label>Phone:</label>
                <input type="text" value="<?php echo e($delivery->phone ?? $order->phone); ?>" readonly class="input-field">
            </div>

            <div class="form-group">
                <label>Order Total:</label>
                <input type="number" value="<?php echo e($delivery->total ?? $order->total); ?>" readonly class="input-field">
            </div>

            <div class="form-group">
                <label for="driver_id">Select Driver:</label>
                <select name="driver_id" id="driver_id" class="input-field" required>
                    <option value="">-- Select Driver --</option>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($driver->id); ?>" <?php echo e((optional($delivery)->driver_id == $driver->id) ? 'selected' : ''); ?>>
                            <?php echo e($driver->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <button type="submit" class="submit-button">Allocate Driver</button>
        </form>
    </div>

    <style>
        .allocation-container {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #ffffff;
            padding: 20px 30px;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .alert {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .allocation-form {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        // Add success message pop-up functionality
        <?php if(session('success')): ?>
            window.onload = function() {
               alert('<?php echo e(session('success')); ?>'); // Show the pop-up message
                window.location.href = '<?php echo e(route('admin.driver.pendingAllocation')); ?>'; // Redirect to the pending allocation page
            };
        <?php endif; ?>
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\driverAllocation.blade.php ENDPATH**/ ?>