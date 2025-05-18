<?php $__env->startSection('content'); ?>
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 800px; margin: auto;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 28px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 22px; font-weight: 600; color: #333;">Employee Details</h2>
                <a href="<?php echo e(route('employees.index')); ?>"
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #E7592B; color: white; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 14px;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 6px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 25px 28px;">
                
                <div style="display: flex; align-items: center; margin-bottom: 25px;">
                    <div style="width: 55px; height: 55px; background-color: #E7592B; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: bold; margin-right: 16px;">
                        <?php echo e(strtoupper(substr($employee->name, 0, 1))); ?>

                    </div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 4px;"><?php echo e($employee->name); ?></h3>
                        <span style="color: #888;">Employee ID: <?php echo e(str_pad($employee->id, 5, '0', STR_PAD_LEFT)); ?></span>
                    </div>
                </div>

                
                <div style="margin-bottom: 25px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin-bottom: 12px;">General Information</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <p><strong>Email:</strong><br><?php echo e($employee->email); ?></p>
                        <p><strong>Phone:</strong><br><?php echo e($employee->phone ?? '-'); ?></p>
                        <p><strong>NIC:</strong><br><?php echo e($employee->nic); ?></p>
                       <p><strong>Position:</strong><br><?php echo e(ucfirst(DB::table('role')->where('role', $employee->position)->value('role'))); ?></p>
                    </div>
                </div>

                <hr style="margin: 20px 0; border: none; border-top: 1px solid #eee;">

                
                <div style="margin-bottom: 10px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin-bottom: 12px;">Address</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <p><strong>Address Line 1:</strong><br><?php echo e($employee->address_line1); ?></p>
                    <?php if(!empty($employee->address_line2)): ?>
                    <p><strong>Address Line 2:</strong><br><?php echo e($employee->address_line2); ?></p>
                    <?php else: ?>
                    <p><strong>Address Line 2:</strong><br>-</p>
                    <?php endif; ?>
                    <p><strong>City:</strong><br><?php echo e($employee->city); ?></p>
                    <p><strong>Postal Code:</strong><br><?php echo e($employee->postal_code); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\employees\show.blade.php ENDPATH**/ ?>