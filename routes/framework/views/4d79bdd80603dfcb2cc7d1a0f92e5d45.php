<?php $__env->startSection('content'); ?>
    <div class="allocation-container">
        <h2>Driver List</h2> <br><br>

        <?php if(session('success')): ?>
            <div class="alert success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert error">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if($drivers->isEmpty()): ?>
            <p>No drivers found.</p>
        <?php else: ?>
            <!-- Search input for driver list -->
            <input type="text" id="searchDrivers" placeholder="Search drivers..." class="search-input">

            <table class="driver-table" id="driversTable">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postal Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($driver->id); ?></td>
                            <td><?php echo e($driver->name); ?></td>
                            <td><?php echo e($driver->nic); ?></td>
                            <td><?php echo e($driver->email); ?></td>
                            <td><?php echo e($driver->phone); ?></td>
                            <td><?php echo e($driver->address_line1); ?> <?php echo e($driver->address_line2); ?></td>
                            <td><?php echo e($driver->city); ?></td>
                            <td><?php echo e($driver->postal_code); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <div class="allocation-container">
        <h2>Drivers Currently on Ride</h2>  <br><br>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(isset($driversOnRide) && $driversOnRide->count() > 0): ?>
            <!-- Search input for drivers on ride -->
            <input type="text" id="searchDriversOnRide" placeholder="Search drivers on ride..." class="search-input">

            <table class="driver-table" id="driversOnRideTable">
                <thead>
                    <tr>
                        <th>Driver Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Assigned Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $driversOnRide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($driver->name); ?></td>
                            <td><?php echo e($driver->phone); ?></td>
                            <td><?php echo e($driver->address_line1 ?? ''); ?> <?php echo e($driver->address_line2 ?? ''); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($driver->order_created_at)->format('Y-m-d H:i')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No drivers are currently on ride.</p>
        <?php endif; ?>
    </div>

<script>
    // Generic function to filter table rows by search input value
    function setupTableSearch(inputId, tableId) {
        const input = document.getElementById(inputId);
        const table = document.getElementById(tableId);
        if (!input || !table) return;

        input.addEventListener('keyup', function() {
            const filter = input.value.toLowerCase();
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                let rowText = rows[i].textContent.toLowerCase();
                rows[i].style.display = rowText.indexOf(filter) > -1 ? '' : 'none';
            }
        });
    }

    // Initialize search for both tables
    setupTableSearch('searchDrivers', 'driversTable');
    setupTableSearch('searchDriversOnRide', 'driversOnRideTable');
</script>

<?php $__env->stopSection(); ?>

<style>
    .allocation-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .alert.success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .alert.error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }

    .driver-table {
        width: 100%;
        border-collapse: collapse;
    }

    .driver-table th, .driver-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .driver-table th {
        background-color: #7e848a;
        color: white;
    }

    .driver-table tr:hover {
        background-color: #f1f1f1;
    }

    .search-input {
        width: 100%;
        max-width: 1000px;
        margin: 10px auto 20px auto;
        display: block;
        padding: 8px 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\driverList.blade.php ENDPATH**/ ?>