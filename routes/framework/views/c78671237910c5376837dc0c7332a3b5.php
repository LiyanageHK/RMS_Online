<?php $__env->startSection('content'); ?>
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: 500;">Overview</h2>
        <input type="text" id="searchInput" placeholder="Search categories..." 
               style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 20px 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 30px 30px;">
        
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 18px; color: #333;">Categories</h3>
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo e(url('admin/categories/create')); ?>"
                   style="padding: 8px 14px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px; transition: background-color 0.3s;">
                    + Add New Category
                </a>
                <button id="downloadReport" class="btn" style="background-color: #E7592B; color: white;">Download Report</button>
            </div>
        </div>

        <!-- Categories Table -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">ID</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Name</th>
                    <th style="padding: 12px; text-align: right;"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;"><?php echo e($cat->id); ?></td>
                        <td style="padding: 12px;"><?php echo e($cat->name); ?></td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="<?php echo e(url('admin/categories/edit/'.$cat->id)); ?>" 
                               style="display: inline-block; background-color: #0d6efd; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="javascript:void(0)" 
                               onclick="showDeleteModal('<?php echo e($cat->id); ?>', '<?php echo e($cat->name); ?>')"
                               style="display: inline-block; background-color: #dc3545; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            <form id="deleteForm-<?php echo e($cat->id); ?>" action="<?php echo e(route('admin.categories.destroy', $cat->id)); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" style="padding: 12px; text-align: center;">No categories found.</td>
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
            <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this category?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.querySelector('table');
    const rows = table.getElementsByTagName('tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value.toLowerCase();

        // Start from 1 to skip header row
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName('td');
            let found = false;

            // Search through each cell in the row
            for (let j = 0; j < cells.length - 1; j++) { // Skip last column (actions)
                const cellText = cells[j].textContent.toLowerCase();
                if (cellText.includes(searchTerm)) {
                    found = true;
                    break;
                }
            }

            // Show/hide row based on search
            row.style.display = found ? '' : 'none';
        }
    });

    // Add fade out for alert
    const alert = document.querySelector('.alert-dismissible');
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.15s ease-in-out';
            setTimeout(() => alert.remove(), 150);
        }, 3000);
    }

    // Download report functionality
    document.getElementById('downloadReport').addEventListener('click', function() {
        const url = '<?php echo e(route('admin.categories.report')); ?>';
        window.location.href = url;
    });
});

function showDeleteModal(id, name) {
    formToSubmit = document.getElementById('deleteForm-' + id);
    document.getElementById('modalMessage').textContent = `Are you sure you want to delete the category "${name}"?`;
    document.getElementById('confirmModal').style.display = 'flex';
}

let formToSubmit = null;

document.getElementById('cancelBtn').addEventListener('click', function () {
    document.getElementById('confirmModal').style.display = 'none';
    formToSubmit = null;
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (formToSubmit) formToSubmit.submit();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\categories\index.blade.php ENDPATH**/ ?>