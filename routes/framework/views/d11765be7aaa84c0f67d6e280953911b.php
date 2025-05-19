<?php $__env->startSection('content'); ?>
<div style="padding: 20px;">
    <h2>Customer Overview</h2>

    <?php if(session('success')): ?>
        <div style="color: green; margin: 10px 0;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <br>

    <a href="<?php echo e(route('customer.create')); ?>" style="padding: 8px 14px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">Add New Customer</a>




    <!-- Search bar -->
<div style="margin: 20px 0; text-align: right;">
    <form method="GET" action="<?php echo e(route('customer.overview')); ?>" style="display: inline-block;">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search here..."
               style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" style="padding: 8px 14px; background-color: #007bff; color: white; border: none; border-radius: 4px;">Search</button>
    </form>
</div>


    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f4f4f4;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="text-align: center;">
                    <td><?php echo e('CUS#' . str_pad($user->user_id, 4, '0', STR_PAD_LEFT)); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->phone); ?></td>
                    <td><?php echo e($user->address); ?></td>
                    <td><?php echo e($user->created_at->format('Y-m-d')); ?></td>
                    <td>
                        <a href="<?php echo e(route('customer.show', $user->user_id)); ?>" style="margin-right: 8px; padding: 6px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">View</a>
                        <a href="<?php echo e(route('customer.edit', $user->user_id)); ?>" style="margin-right: 8px; padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Edit</a>
                        <button onclick="confirmDelete(<?php echo e($user->user_id); ?>)" style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No customers found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Hidden delete form -->
    <form id="deleteForm" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>






<!-- Custom Confirmation Modal -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
            <div style="margin-bottom: 15px;">
                <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
            </div>
            <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
            <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this employee?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
    let userIdToDelete = null;

    function confirmDelete(userId) {
        userIdToDelete = userId;
        document.getElementById('modalMessage').textContent = `Are you sure you want to delete customer CUS#${String(userId).padStart(4, '0')}?`;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    document.getElementById('cancelBtn').addEventListener('click', function () {
        document.getElementById('confirmModal').style.display = 'none';
        userIdToDelete = null;
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (userIdToDelete !== null) {
            const form = document.getElementById('deleteForm');
            form.action = `/customer/${userIdToDelete}`; // adjust route prefix if needed
            form.submit();
        }
    });
</script>





</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\customer\cusOverview.blade.php ENDPATH**/ ?>