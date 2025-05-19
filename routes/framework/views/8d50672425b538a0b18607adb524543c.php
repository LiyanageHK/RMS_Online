<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Edit Role</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="roleForm" action="<?php echo e(route('admin.role.update', $role->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="_method" value="POST">

        <div class="mb-3">
            <label for="role" class="form-label">Role Name</label>
            <input type="text" name="role" id="role" class="form-control" value="<?php echo e(old('role', $role->role)); ?>" required>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"><?php echo e(old('description', $role->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Permission Toggles -->
        <div class="mb-3">
            <h5>Permissions</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="inv" id="inv" 
                            <?php echo e(old('inv', $permissions->inv) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="inv">Inventory Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="cus" id="cus" 
                            <?php echo e(old('cus', $permissions->cus) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="cus">Customer Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="order" id="order" 
                            <?php echo e(old('order', $permissions->order) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="order">Order Center</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="deli" id="deli" 
                            <?php echo e(old('deli', $permissions->deli) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="deli">Delivery Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="emp" id="emp" 
                            <?php echo e(old('emp', $permissions->emp) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="emp">Employee Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="acc" id="acc" 
                            <?php echo e(old('acc', $permissions->acc) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="acc">Access Management Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="pro" id="pro" 
                            <?php echo e(old('pro', $permissions->pro) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="pro"> Procurement Center</label>
                    </div>
                     <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="crm" id="crm" 
                            <?php echo e(old('pro', $permissions->crm) == '1' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="pro">Customer relations Center</label>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
        <a href="<?php echo e(route('admin.role.index')); ?>" class="btn btn-secondary">Back to Roles</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\role\edit.blade.php ENDPATH**/ ?>