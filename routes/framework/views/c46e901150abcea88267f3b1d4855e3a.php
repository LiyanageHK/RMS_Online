<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Edit Category</h3>

    <form action="/admin/categories/update/<?php echo e($category->id); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e($category->name); ?>" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/admin/categories" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\categories\edit.blade.php ENDPATH**/ ?>