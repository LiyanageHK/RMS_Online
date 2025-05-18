<?php $__env->startSection('title', 'Employee Login'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.login')); ?>">
    <?php echo csrf_field(); ?>

    <!-- Email Input -->
    <div class="form-group">
        <div class="input-group">
            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="Employee Email" name="email" value="<?php echo e(old('email')); ?>"
                   required autocomplete="email" autofocus>
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
        </div>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Password Input -->
    <div class="form-group">
        <div class="input-group">
            <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="Employee Password" name="password" required autocomplete="current-password">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
        </div>
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($message); ?></strong>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Remember Me & Forgot Password -->
    <!-- <div class="remember-forgot">
        <div class="remember-me">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember"
                       name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <?php if(Route::has('password.request')): ?>
            <div class="forgot-password">
                <a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
            </div>
        <?php endif; ?>
    </div> -->

    <!-- Login Button -->
    <div class="form-group">
        <button type="submit" class="btn btn-secondary btn-block" style="background-color: #E7592B; border-color: #E7592B;">
            Employee Login
        </button>
    </div>

    <!-- Divider -->
    <!-- <div class="divider">OR</div> -->

</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\auth\login.blade.php ENDPATH**/ ?>