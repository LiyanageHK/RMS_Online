<?php $__env->startSection('content'); ?>
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 950px; margin: auto;">
        <div style="background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 25px 30px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 24px; font-weight: 700; color: #333;">Contact Message from <?php echo e($message->name); ?></h2>
                <a href="<?php echo e(route('contact.index')); ?>"
                   style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #E7592B; color: white; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 8px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 30px 30px;">
                
                <div style="margin-bottom: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #E7592B; margin-bottom: 15px;">Message Details</h4>
                    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <p><strong style="color: #333;">Email:</strong> <span style="color: #555;"><?php echo e($message->email); ?></span></p>
                        <p><strong style="color: #333;">Message:</strong></p>
                        <p style="color: #555; line-height: 1.6;"><?php echo e($message->message); ?></p>
                    </div>
                </div>

                
                <div style="margin-top: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #E7592B; margin-bottom: 15px;">Reply to Message</h4>
                    <form method="POST" action="<?php echo e(route('contact.reply', $message->id)); ?>" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <?php echo csrf_field(); ?>
                        <label for="reply" style="font-weight: 600; font-size: 16px; color: #333;">Reply Message:</label>
                        <textarea name="reply" id="reply" class="w-full border rounded p-3" rows="6" style="font-size: 16px; color: #333; border: 1px solid #ddd; resize: vertical; width: 100%; max-width: 900px;" required></textarea>
                        
                        
                        <div style="text-align: right; margin-top: 20px;">
                            <button type="submit" style="background-color: #E7592B; color: white; padding: 12px 24px; border-radius: 8px; font-weight: 500; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                Send Reply
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\contact\show.blade.php ENDPATH**/ ?>