<?php $__env->startSection('content'); ?>
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: bold;">Goods Received Notes (GRNs)</h2>
        <form method="GET" action="<?php echo e(route('grns.index')); ?>">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                   placeholder="Search GRNs..." 
                   oninput="if(this.value==='') this.form.submit();"
                   style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        </form>
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 25px 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 40px 30px;">
        
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; font-size: 18px; color: #333;">Overview</h3>
            <a href="<?php echo e(route('grns.create')); ?>"
               style="padding: 8px 14px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px; transition: background-color 0.3s;">
                + Add New GRN
            </a>
        </div>

        <!-- GRN Table -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">GRN Number</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Supplier</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">GRN Date</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Reference</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Item Count</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $grns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;">GRN<?php echo e(str_pad($grn->id, 5, '0', STR_PAD_LEFT)); ?></td>
                        <td style="padding: 12px;"><?php echo e($grn->supplier->name); ?></td>
                        <td style="padding: 12px;"><?php echo e(\Carbon\Carbon::parse($grn->grn_date)->format('Y-m-d')); ?></td>
                        <td style="padding: 12px;" class="<?php echo e($grn->reference ? '' : 'center'); ?>">
    <?php echo e($grn->reference ? 'PO' . str_pad($grn->reference, 5, '0', STR_PAD_LEFT) : '-'); ?>

</td>
                        <td style="padding: 12px; text-align: center;"><?php echo e($grn->items->count()); ?></td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="<?php echo e(route('grns.show', $grn->id)); ?>" style="margin-right: 8px; background-color: #6c757d; color: white; padding: 6px 10px; border-radius: 4px; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span> View
                            </a>
                            <form action="<?php echo e(route('grns.destroy', $grn->id)); ?>" method="POST" class="delete-form" style="display: inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" class="delete-button" data-name="GRN<?php echo e(str_pad($grn->id, 5, '0', STR_PAD_LEFT)); ?>" style="background-color: #dc3545; color: white; padding: 6px 10px; border: none; border-radius: 4px; font-size: 13px; display: inline-flex; align-items: center; cursor: pointer;">
                                    <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="padding: 12px; text-align: center;">No GRNs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Custom Confirmation Modal -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
            <div style="margin-bottom: 15px;">
                <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
            </div>
            <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
            <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this GRN?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let formToSubmit = null;

            document.querySelectorAll('.delete-button').forEach(button => {
                button.style.cursor = 'pointer';
                button.addEventListener('mouseover', () => button.style.cursor = 'pointer');
                button.addEventListener('click', function () {
                    formToSubmit = this.closest('form');
                    const name = this.getAttribute('data-name');
                    document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${name}"?`;
                    document.getElementById('confirmModal').style.display = 'flex';
                });
            });

            document.getElementById('cancelBtn').addEventListener('click', function () {
                document.getElementById('confirmModal').style.display = 'none';
                formToSubmit = null;
            });

            document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                if (formToSubmit) formToSubmit.submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\GRN\index.blade.php ENDPATH**/ ?>