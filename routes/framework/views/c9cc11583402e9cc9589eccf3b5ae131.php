<?php $__env->startSection('content'); ?>
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 950px; margin: auto;">
        <div style="background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 25px 30px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 24px; font-weight: 700; color: #333;">Feedback from <?php echo e($feedback->name); ?></h2>
                <a href="<?php echo e(route('feedback.index')); ?>"
                   style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #E7592B; color: white; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 8px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 30px 30px;">
                
                <div style="margin-bottom: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #E7592B; margin-bottom: 15px;">Feedback Details</h4>
                    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <p><strong style="color: #333;">Feedback:</strong></p>
                        <p style="color: #555; line-height: 1.6;"><?php echo e($feedback->feedback); ?></p>
                    </div>
                </div>

                
                <div style="margin-bottom: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #E7592B; margin-bottom: 15px;">Submitted On</h4>
                    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <p style="color: #555; font-size: 16px;"><?php echo e($feedback->created_at->format('M d, Y')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\feedback\show.blade.php ENDPATH**/ ?>