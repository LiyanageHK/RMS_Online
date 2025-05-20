<?php $__env->startSection('title', 'Create Employee'); ?>

<?php $__env->startSection('content'); ?>
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 800px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">

        <!-- Title + Cancel Button -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Create Employee</h2>
            <a href="<?php echo e(route('employees.index')); ?>" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="<?php echo e(route('employees.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <!-- Display Validation Errors -->
            <?php if($errors->any()): ?>
                <div style="background-color: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <ul style="list-style: none; margin: 0; padding: 0;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="color: #721c24;"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Fields -->
            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #F9F9F9;">
                <!-- Full Name -->
                <div style="margin-bottom: 20px;">
                    <label for="name" style="font-weight: bold;">Full Name <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <!-- Email Address -->
                <div style="margin-bottom: 20px;">
                    <label for="email" style="font-weight: bold;">Email Address <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        oninput="validateEmail()" placeholder="example@example.com">
                    <small id="email-error" style="color: red; display: none;">Please enter a valid email address.</small>
                </div>

                <!-- NIC -->
                <div style="margin-bottom: 20px;">
                    <label for="nic" style="font-weight: bold;">NIC <span style="color: red;">*</span></label>
                    <input type="text" id="nic" name="nic" value="<?php echo e(old('nic')); ?>" required style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <small style="color: #555;">NIC will be used as the default password. The employee can change it later.</small>
                </div>

                <!-- Phone Number -->
                <div style="margin-bottom: 20px;">
                    <label for="phone" style="font-weight: bold;">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" 
                        pattern="^\+94[0-9]{9}$" oninput="validatePhone()" placeholder="+94XXXXXXXXX">
                    <small id="phone-error" style="color: red; display: none;">Please enter a valid phone number (+94XXXXXXXXX).</small>
                </div>

                <!-- Position -->
                <div style="margin-bottom: 20px;">
                    <label for="position" style="font-weight: bold;">Position <span style="color: red;">*</span></label>
                    <select id="position" name="position" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    <option value="">Select Position</option>
    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($role->role); ?>" <?php echo e(old('position') == $role->role ? 'selected' : ''); ?>><?php echo e($role->role); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
                </div>

                <!-- Address and Other Fields -->
                <div style="margin-bottom: 20px;">
                    <label for="address_line1" style="font-weight: bold;">Address Line 1 <span style="color: red;">*</span></label>
                    <input type="text" id="address_line1" name="address_line1" value="<?php echo e(old('address_line1')); ?>" required style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="address_line2" style="font-weight: bold;">Address Line 2</label>
                    <input type="text" id="address_line2" name="address_line2" value="<?php echo e(old('address_line2')); ?>" style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="city" style="font-weight: bold;">City <span style="color: red;">*</span></label>
                    <input type="text" id="city" name="city" value="<?php echo e(old('city')); ?>" required style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="postal_code" style="font-weight: bold;">Postal Code <span style="color: red;">*</span></label>
                    <input type="text" id="postal_code" name="postal_code" value="<?php echo e(old('postal_code')); ?>" required style="width: 97%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <!-- Buttons -->
            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <button type="submit" style="background-color: #E7592B; color: white; font-size: 14px; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer;">
                    Save Employee
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Real-time validation for email
    function validateEmail() {
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('email-error');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        
        if (!email.match(emailPattern)) {
            emailError.style.display = 'block';
        } else {
            emailError.style.display = 'none';
        }
    }

    // Real-time validation for phone number
    function validatePhone() {
        const phone = document.getElementById('phone').value;
        const phoneError = document.getElementById('phone-error');
        const phonePattern = /^\+94[0-9]{9}$/;
        
        if (!phone.match(phonePattern)) {
            phoneError.style.display = 'block';
        } else {
            phoneError.style.display = 'none';
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\employees\create.blade.php ENDPATH**/ ?>