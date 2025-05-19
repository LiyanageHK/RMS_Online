<?php $__env->startSection('title', 'Low Stock Alerts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Low Stock Items
                    </h3>
                </div>
                <div class="card-body">
                    <form id="bulkNotifyForm" method="POST" action="<?php echo e(route('admin.inventory.send-bulk-low-stock-alert')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Send Alerts To:</label>
                                <select name="employee_id" class="form-control" required>
                                    <option value="">Select Admin</option>
                                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($admin->id); ?>"><?php echo e($admin->name); ?> (<?php echo e($admin->email); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-paper-plane mr-1"></i> Send Alerts for Selected Items
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Current Stock</th>
                                        <th>Alert Level</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $lowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="<?php echo e($item->on_hand_quantity <= 0 ? 'table-danger' : ''); ?>">
                                        <td>
                                            <input type="checkbox" name="item_ids[]" value="<?php echo e($item->item_id); ?>" class="item-checkbox">
                                        </td>
                                        <td><?php echo e($item->item_name); ?></td>
                                        <td><?php echo e($item->category_name); ?></td>
                                        <td><?php echo e($item->on_hand_quantity); ?></td>
                                        <td><?php echo e($item->alert_level); ?></td>
                                        <td>
                                            <span class="badge badge-danger">
                                                <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($item->stock_status); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.inventory.show', $item->item_id)); ?>" 
                                               class="btn btn-sm btn-info" title="View details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <form method="POST" action="<?php echo e(route('admin.inventory.send-low-stock-alert')); ?>" 
                                                  style="display: inline-block;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="item_id" value="<?php echo e($item->item_id); ?>">
                                                <input type="hidden" name="employee_id" value="<?php echo e($admins->first()->id ?? ''); ?>">
                                                <button type="submit" class="btn btn-sm btn-warning" title="Send alert">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                                            <h5>No low stock items found!</h5>
                                            <p class="mb-0">All inventory items are above their alert thresholds.</p>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <?php if($lowStock->count() > 0): ?>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-danger">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            <?php echo e($lowStock->count()); ?> item(s) need attention
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Form submission confirmation
    document.getElementById('bulkNotifyForm').addEventListener('submit', function(e) {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');
        if (checkedItems.length === 0) {
            e.preventDefault();
            alert('Please select at least one item to notify about');
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\inventory\low-stock.blade.php ENDPATH**/ ?>