<?php $__env->startSection('content'); ?>
<div class="allocation-container">
    <h2>Delivery History</h2><br><br>

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

                <div class="search-filter">
                    <input type="text" id="searchInput" placeholder="Search deliveries..." onkeyup="filterTable()">
                </div>
            </div>

    <?php if($deliveries->isEmpty()): ?>
        <p>No deliveries found.</p>
    <?php else: ?>
        <table class="driver-table" id="deliveryTable">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Order ID</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Driver Allocated</th>
                    <th>Total Amount</th>
                    <th>Driver Allocate At</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e('DLY#' . str_pad($delivery->delivery_id, 4, '0', STR_PAD_LEFT)); ?></td>
                        <td><?php echo e($delivery->order_id); ?></td>
                        <td><?php echo e($delivery->address ?? 'N/A'); ?></td>
                        <td><?php echo e($delivery->phone ?? 'N/A'); ?></td>
                        <td><?php echo e($delivery->assigned_to ?? 'N/A'); ?></td>
                        <td><?php echo e($delivery->total ?? 'N/A'); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($delivery->created_at)->format('Y-m-d H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('deliveryTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(" ");
            const show = rowText.includes(input);
            rows[i].style.display = show ? '' : 'none';
        }
    }
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

    .search-filter {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .search-filter input, .search-filter select {
        padding: 10px;
        width: 48%;
        border: 1px solid #ccc;
        border-radius: 5px;
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



    .search-filter {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }





    }


    }
</style>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\driver\deliveryHistory.blade.php ENDPATH**/ ?>