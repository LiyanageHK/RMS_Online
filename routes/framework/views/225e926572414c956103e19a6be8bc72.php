<?php $__env->startSection('content'); ?>

<div style="padding: 20px;">

    <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
            Driver Allocation Details
        </h1>
    </div>

    <!-- Deliveries Table -->
  <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Delivery ID</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order ID</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Address</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Landmark</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Phone</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Total</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Assigned To</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Download PDF</th> <!-- New column -->
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <?php echo e('DLY#' . sprintf('%03d', $delivery->delivery_id)); ?>

                </td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    ORD-<?php echo e($delivery->order_id); ?>

                </td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <?php echo e($delivery->address); ?>

                </td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <?php echo e(!empty($delivery->landmark) ? $delivery->landmark : '-'); ?>

                </td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <?php echo e($delivery->phone); ?>

                </td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    Rs. <?php echo e(number_format($delivery->total, 2)); ?>

                </td>
                <td style="padding: 12px; border: 1px solid #ddd;">
                    <?php echo e($delivery->driver->name ?? $delivery->assigned_to ?? 'Unassigned'); ?>

                </td>

                <!-- New separate column for Download PDF button -->
                <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                    <?php if($delivery->order): ?>
                        <a href="<?php echo e(route('admin.driver.downloadReport', ['orderId' => $delivery->order->id])); ?>"
                           style="background-color: #28a745; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                            Download PDF
                        </a>
                    <?php else: ?>
                        <span style="color: #888;">N/A</span>
                    <?php endif; ?>
                </td>

                <td style="padding: 12px; border: 1px solid #ddd;">
                    <a href="<?php echo e(route('admin.driver.edit.delivery', ['delivery_id' => $delivery->delivery_id])); ?>"
                       style="background-color: #007bff; color: white; padding: 8px 16px; border-radius: 5px; font-weight: bold; text-decoration: none; margin-right: 5px; display: inline-block;">
                        Edit
                    </a>

                    <form id="deleteForm-<?php echo e($delivery->delivery_id); ?>"
                          action="<?php echo e(route('admin.driver.delete.delivery', ['delivery_id' => $delivery->delivery_id])); ?>"
                          method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button"
                                onclick="showDeleteModal(<?php echo e($delivery->delivery_id); ?>, 'Delivery #<?php echo e($delivery->delivery_id); ?>')"
                                style="background-color: #e7592b; color: white; padding: 8px 16px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="9" style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                    No delivery details available
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


    <div style="margin: 20px 0;">
        <a href="<?php echo e(route('admin.driver.pendingAllocation')); ?>"
           style="text-decoration: none; color: #007bff; font-weight: bold; font-size: 16px;">
            ← Back to Pending Allocations
        </a>
    </div>

</div>

<!-- Custom Confirmation Modal -->
<div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
    <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
        <div style="margin-bottom: 15px;">
            <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
        </div>
        <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
        <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this delivery?</p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
            <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
        </div>
    </div>
</div>

<!-- Modal Script -->
<script>
    let formToSubmit = null;

    function showDeleteModal(id, name) {
        formToSubmit = document.getElementById('deleteForm-' + id);
        document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${name}"?`;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    document.getElementById('cancelBtn').addEventListener('click', function () {
        document.getElementById('confirmModal').style.display = 'none';
        formToSubmit = null;
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (formToSubmit) formToSubmit.submit();
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\allocation_details.blade.php ENDPATH**/ ?>