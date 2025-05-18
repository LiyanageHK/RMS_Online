<?php $__env->startSection('title', 'Item Details: ' . $item->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        <i class="fas fa-box-open mr-2"></i> Item Details: <?php echo e($item->name); ?>

                    </h3>
                    <div class="card-tools">
                        <a href="<?php echo e(route('admin.inventory.index')); ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Inventory
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Item Information Card -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle mr-2"></i>Basic Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4">Category:</dt>
                                        <dd class="col-sm-8"><?php echo e($item->category_name); ?></dd>

                                        <dt class="col-sm-4">Description:</dt>
                                        <dd class="col-sm-8"><?php echo e($item->description ?? 'N/A'); ?></dd>

                                        <dt class="col-sm-4">Unit Price:</dt>
                                        <dd class="col-sm-8">Rs. <?php echo e(number_format($item->price, 2)); ?></dd>

                                        <dt class="col-sm-4">Alert Level:</dt>
                                        <dd class="col-sm-8"><?php echo e($item->alert_level); ?></dd>

                                        <dt class="col-sm-4">Current Stock:</dt>
                                        <dd class="col-sm-8">
                                            <span class="badge badge-<?php echo e($currentStock <= $item->alert_level ? 'danger' : 'success'); ?> p-2">
                                                <?php echo e($currentStock); ?>

                                                <?php if($currentStock <= $item->alert_level): ?>
                                                    <i class="fas fa-exclamation-circle ml-1"></i>
                                                <?php endif; ?>
                                            </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Summary Card -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-pie mr-2"></i>Stock Summary
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-4 border-right">
                                            <div class="text-muted">Total Received</div>
                                            <h3 class="text-success"><?php echo e($grnHistory->sum('quantity')); ?></h3>
                                        </div>
                                        <div class="col-4 border-right">
                                            <div class="text-muted">Total Used</div>
                                            <h3 class="text-danger"><?php echo e($orderHistory->sum('item_quantity')); ?></h3>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-muted">Current Stock</div>
                                            <h3 class="<?php echo e($currentStock <= $item->alert_level ? 'text-danger' : 'text-primary'); ?>">
                                                <?php echo e($currentStock); ?>

                                            </h3>
                                        </div>
                                    </div>
                                    <hr>
                                   <div class="text-center">
    <?php if($currentStock <= $item->alert_level): ?>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reorderModal-<?php echo e($item->id); ?>">
            <i class="fas fa-shopping-cart mr-1"></i> Reorder Item
        </button>
        
        <!-- Reorder Modal -->
        <div class="modal fade" id="reorderModal-<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="reorderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="reorderModalLabel">Low Stock Notification</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.inventory.send-low-stock-alert', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Item Details</label>
                                <input type="text" class="form-control" value="<?php echo e($item->name); ?> (Current Stock: <?php echo e($currentStock); ?>, Alert Level: <?php echo e($item->alert_level); ?>)" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Select Admins to Notify</label>
                                <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="recipients[]" value="<?php echo e($admin->email); ?>" id="admin-<?php echo e($admin->id); ?>-<?php echo e($item->id); ?>" checked>
                                        <label class="form-check-label" for="admin-<?php echo e($admin->id); ?>-<?php echo e($item->id); ?>">
                                            <?php echo e($admin->name); ?> (<?php echo e($admin->position); ?>)
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Additional Message (Optional)</label>
                                <textarea name="additional_message" class="form-control" rows="3" placeholder="Add any special instructions..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-paper-plane mr-1"></i> Send Notification
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <span class="text-success">
            <i class="fas fa-check-circle mr-1"></i> Stock level is acceptable
        </span>
    <?php endif; ?>
</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction History -->
                    <div class="row">
                        <!-- GRN History -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-arrow-down mr-2"></i>Receiving History
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>GRN Reference</th>
                                                    <th class="text-right">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $grnHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Carbon\Carbon::parse($grn->grn_date)->format('M d, Y')); ?></td>
                                                    <td><?php echo e($grn->reference ?? 'N/A'); ?></td>
                                                    <td class="text-right text-success">+<?php echo e($grn->quantity); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-3">No receiving history found</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order History -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-arrow-up mr-2"></i>Usage History
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Order #</th>
                                                    <th class="text-right">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $orderHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(\Carbon\Carbon::parse($order->order_date)->format('M d, Y')); ?></td>
                                                    <td>#<?php echo e($order->order_id); ?></td>
                                                    <td class="text-right text-danger">-<?php echo e($order->item_quantity); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-3">No usage history found</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\inventory\show.blade.php ENDPATH**/ ?>