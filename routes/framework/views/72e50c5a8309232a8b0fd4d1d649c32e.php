<?php $__env->startSection('content'); ?>
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 800px; margin: auto;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 28px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 22px; font-weight: 600; color: #333;">Goods Received Note</h2>
                <a href="<?php echo e(route('grns.index')); ?>"
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #E7592B; color: white; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 14px;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 6px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 25px 28px;">
                
                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 6px;">GRN #<?php echo e(str_pad($grn->id, 5, '0', STR_PAD_LEFT)); ?></h3>
                    <span style="color: #888;">Date: <?php echo e(\Carbon\Carbon::parse($grn->grn_date)->format('d M Y')); ?></span><br>
                    <?php if($grn->reference): ?>
                        <span style="color: #555;">Reference #: <strong><?php echo e($grn->reference); ?></strong></span>
                    <?php endif; ?>
                </div>

                
                <div style="margin-bottom: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin-bottom: 12px;">Supplier</h4>
                    <p style="margin: 0;"><?php echo e($grn->supplier->name); ?></p>
                    <p style="color: #666;"><?php echo e($grn->supplier->email); ?> | <?php echo e($grn->supplier->phone); ?></p>
                </div>

                
                <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin: 20px 0 12px;">Received Items</h4>
                <table style="width: 100%; border-collapse: collapse; background-color: #fff;">
                    <thead>
                        <tr style="background-color: #f3f3f3; text-align: left;">
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Item</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Price</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Quantity</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $grn->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grnItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo e($grnItem->item->item_name ?? '-'); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;">Rs. <?php echo e(number_format($grnItem->item->price ?? 0, 2)); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo e($grnItem->quantity); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;">Rs. <?php echo e(number_format(($grnItem->item->price ?? 0) * $grnItem->quantity, 2)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right; font-weight: bold; padding: 10px; border-top: 1px solid #ddd;">Total Amount:</td>
                            <td style="padding: 10px; border-top: 1px solid #ddd;">Rs. <?php echo e(number_format($grn->total_amount, 2)); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\GRN\show.blade.php ENDPATH**/ ?>