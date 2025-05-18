<?php $__env->startComponent('mail::message'); ?>
# Low Stock Alert

**Item Name:** <?php echo e($item->name); ?>  
**Current Stock:** <?php echo e($currentStock); ?>  
**Alert Level:** <?php echo e($item->alert_level); ?>  

<?php if($additionalMessage): ?>
**Additional Notes:**  
<?php echo e($additionalMessage); ?>

<?php endif; ?>

<?php $__env->startComponent('mail::button', ['url' => route('admin.inventory.show', $item->id)]); ?>
View Item Details
<?php echo $__env->renderComponent(); ?>

**Urgency:**  
<span style="color: #dc3545; font-weight: bold;">Immediate attention required</span>

Thanks,  
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\emails\low_stock_alert.blade.php ENDPATH**/ ?>