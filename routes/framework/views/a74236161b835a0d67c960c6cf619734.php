
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Flame & Crust</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



<div class="container">
    <h2>Welcome, <?php echo e($user->name); ?></h2>
    <p><?php echo e(\Carbon\Carbon::now()->format('D, d M Y')); ?></p>

    <div class="profile-card">
        <div class="info">
            <h3><?php echo e($user->name); ?></h3>
            <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
            <p><strong>Contact:</strong> <?php echo e($user->phone ?? 'N/A'); ?></p>
            <p><strong>Address:</strong> <?php echo e($user->address ?? 'N/A'); ?></p>

            <?php if(isset($loyalty)): ?>
                <p><strong>Loyalty Level:</strong>
                    <span class="loyalty-badge <?php echo e(strtolower($loyalty->loyalty_level)); ?>">
                        <?php echo e($loyalty->loyalty_level); ?>

                    </span>
                </p>
<?php endif; ?>

        </div>
    </div>



    <br>
    <br>





    <!-- Add the Edit Modal -->
<div class="edit-modal" id="editModal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Edit Profile</h2>

        <form id="profileForm" action="<?php echo e(route('profile.update', ['user' => $user->user_id])); ?>" method="POST" onsubmit="return confirmEdit()">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php if($errors->any()): ?>
            <div class="error-messages">
                <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="color: red;"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>



            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address"><?php echo e(old('address', $user->address)); ?></textarea>
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" name="password_confirmation" placeholder="Re-enter new password">
            </div>


            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Client-side form validation
    document.querySelector('form').addEventListener('submit', function(event) {
        let isValid = true;
        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const phone = document.querySelector('input[name="phone"]').value;

        // Validate Name
        if (name.trim() === '') {
            alert('Name is required.');
            isValid = false;
        }

        // Validate Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            isValid = false;
        }

        // Validate Phone (if provided)
        if (phone.trim() !== '' && !/^\d{10}$/.test(phone)) {
            alert('Please enter a valid phone number (10 digits).');
            isValid = false;
        }

        // Validate Password (if provided)
        const password = document.querySelector('input[name="password"]').value;
        if (password.trim() !== '') {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/;
            if (!passwordRegex.test(password)) {
                alert('Password must be at least 8 characters and include uppercase, lowercase, number, and special character.');
                isValid = false;
            }
        }


        // If not valid, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

<!-- Edit Button -->
<a href="#" class="btn-edit" id="editBtn">Edit Profile Details</a>


<script>
    const editBtn = document.getElementById('editBtn');
    const modal = document.getElementById('editModal');
    const closeModal = document.getElementById('closeModal');

    // Open the modal when Edit button is clicked
    editBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close the modal if user clicks outside the modal
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>






<?php if($errors->any()): ?>
    <script>
        window.addEventListener('load', function () {
            document.getElementById('editModal').style.display = 'block';
        });
    </script>
<?php endif; ?>




<?php if(session('success')): ?>
<div class="alert alert-success">
<?php echo e(session('success')); ?>

</div>
<?php endif; ?>




    <?php if($errors->any()): ?>
        <div class="error-messages">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li style="color: red;"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

      <div class="button-group">


        <a href="<?php echo e(route('profile.orders')); ?>" class="btn">View Order History</a>

    </div>

</div>


<div class="profile-sections icon-only">

  <!-- Floating Shopping Cart Icon -->
<a href="#" class="floating-cart" title="Shopping Cart">
    <i class="fas fa-shopping-cart fa-2x"></i>
</a>






<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


</body>
</html>
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\profile.blade.php ENDPATH**/ ?>