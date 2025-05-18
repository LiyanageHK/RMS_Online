<?php $__env->startSection('content'); ?>

<div style="padding: 20px;">

    <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
            Edit Driver Allocation
        </h1>
    </div>

    <form action="<?php echo e(route('admin.driver.edit', ['delivery_id' => $delivery->delivery_id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
         <?php echo method_field('PUT'); ?>
        <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd;">
            <div style="margin-bottom: 15px;">
                <label for="order_id" style="font-weight: bold;">Order ID</label>
                <input type="text" id="order_id" name="order_id" value="<?php echo e($delivery->order_id); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="address" style="font-weight: bold;">Address</label>
                <input type="text" id="address" name="address" value="<?php echo e($delivery->address); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="landmark" style="font-weight: bold;">Landmark</label>
                <input type="text" id="landmark" name="landmark" value="<?php echo e($delivery->landmark); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="phone" style="font-weight: bold;">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo e($delivery->phone); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="total" style="font-weight: bold;">Total</label>
                <input type="text" id="total" name="total" value="<?php echo e($delivery->total); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="driver_id" style="font-weight: bold;">Assign Driver</label>
                <select id="driver_id" name="driver_id" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($driver->id); ?>" <?php echo e($delivery->driver_id == $driver->id ? 'selected' : ''); ?>>
                            <?php echo e($driver->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>


            <div style="margin-bottom: 15px;">
                <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">
                    Save Changes
                </button>
            </div>

        </div>
    </form>

    <div style="margin: 20px 0;">
        <a href="<?php echo e(route('admin.driver.allocation.details')); ?>" style="text-decoration: none; color: #007bff; font-weight: bold; font-size: 16px;">
            ← Back to Allocation Details
        </a>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\edit_delivery.blade.php ENDPATH**/ ?>