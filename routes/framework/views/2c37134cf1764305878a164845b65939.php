<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Item</h2>
    <form method="POST" action="<?php echo e(url('admin/items/update/'.$item->id)); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" name="name" value="<?php echo e($item->name); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e($item->category_id == $cat->id ? 'selected' : ''); ?>>
                        <?php echo e($cat->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Price (Rs.)</label>
            <input type="number" name="price" step="0.01" value="<?php echo e($item->price); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"><?php echo e($item->description); ?></textarea>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\items\edit.blade.php ENDPATH**/ ?>