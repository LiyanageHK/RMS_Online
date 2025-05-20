<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Add Category</h3>

    <form action="/admin/categories/store" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="/admin/categories" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\categories\create.blade.php ENDPATH**/ ?>