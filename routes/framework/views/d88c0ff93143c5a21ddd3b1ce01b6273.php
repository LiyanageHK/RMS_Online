<?php $__env->startSection('content'); ?>
<div class="container-custom">
    <div class="content-wrapper">
        <h2 class="heading">Send Email to Customers</h2>

        <?php if($customers->count()): ?>
            <form method="POST" action="#">
                <?php echo csrf_field(); ?>

                <div class="flex-container">
                    
                    <div class="form-section">
                        <div class="form-group">
                            <label for="subject" class="label">Subject</label>
                            <input type="text" id="subject" name="subject" class="input" required>
                        </div>

                        <div class="form-group">
                            <label for="body" class="label">Message</label>
                            <textarea id="body" name="body" rows="6" class="textarea" required></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="send-btn">Send Email</button>
                        </div>
                    </div>

                    <div class="form-actions">
    <button type="button" class="prev-btn">Previous Email</button>
</div>



                    
                    <div class="table-section">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Customer Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" name="user_ids[]" value="<?php echo e($customer->user_id); ?>"></td>
                                        <td><?php echo e(($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration); ?></td>
                                        <td><?php echo e($customer->name); ?></td>
                                        <td><?php echo e($customer->email); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <div class="pagination">
                            <?php if($customers->onFirstPage()): ?>
                                <span>&laquo; Prev</span>
                            <?php else: ?>
                                <a href="<?php echo e($customers->previousPageUrl()); ?>">&laquo; Prev</a>
                            <?php endif; ?>

                            <span>Page <?php echo e($customers->currentPage()); ?> of <?php echo e($customers->lastPage()); ?></span>

                            <?php if($customers->hasMorePages()): ?>
                                <a href="<?php echo e($customers->nextPageUrl()); ?>">Next &raquo;</a>
                            <?php else: ?>
                                <span>Next &raquo;</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <p class="no-customers">No customers found.</p>
        <?php endif; ?>
    </div>
</div>







<?php $__env->stopSection(); ?>



<style>

    /* Container */
.container-custom {
  max-width: 1200px;
  height: auto;
  margin: 40px auto;
  padding: 20px 30px;
  background-color: #fff;
  box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1),
              0 4px 6px -4px rgba(0,0,0,0.1);
  border-radius: 16px;
}

/* Heading */
.heading {
  font-size: 2rem;
  font-weight: 700;
  color: #2d3748; /* dark gray */
  margin-bottom: 24px;
}

/* Flex container for form and table side by side */
.flex-container {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

/* On wider screens, row layout */
@media (min-width: 1024px) {
  .flex-container {
    flex-direction: row;
  }
}

/* Left form section */
.form-section {
  flex: 1;
  background: #f9fafb;
  padding: 24px;
  border-radius: 12px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
}

/* Form group */
.form-group {
  margin-bottom: 24px;
}

/* Labels */
.label {
  display: block;
  font-weight: 600;
  margin-bottom: 8px;
  color: #4a5568; /* gray-700 */
  font-size: 0.9rem;
}

/* Inputs */
.input, .textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #cbd5e0; /* gray-300 */
  border-radius: 8px;
  font-size: 1rem;
  color: #2d3748;
  resize: vertical;
  transition: border-color 0.3s;
}

.input:focus, .textarea:focus {
  outline: none;
  border-color: #3182ce; /* blue-600 */
  box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.6);
}

/* Submit button */
.send-btn {
  background-color: #2563eb;
  color: white;
  padding: 10px 24px;
  font-size: 1rem;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s;
}

.send-btn:hover {
  background-color: #1d4ed8;
}

/* Right table section */
.table-section {
  flex: 1;
  max-height: 500px;
  overflow-y: auto;
}

/* Table styles */
.custom-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.9rem;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow: hidden;
}

.custom-table thead {
  background-color: #edf2f7;
  text-transform: uppercase;
  color: #4a5568;
  font-size: 0.8rem;
}

.custom-table th,
.custom-table td {
  padding: 12px 16px;
  border-bottom: 1px solid #e2e8f0;
  text-align: left;
}

.custom-table tbody tr:hover {
  background-color: #f7fafc;
}

/* Checkbox */
input[type="checkbox"] {
  width: 16px;
  height: 16px;
  cursor: pointer;
  accent-color: #2563eb;
}

/* Pagination */
.pagination {
  margin-top: 16px;
  display: flex;
  justify-content: center;
  gap: 12px;
  font-size: 0.9rem;
  color: #2563eb;
}

.pagination a {
  text-decoration: none;
  cursor: pointer;
  color: #2563eb;
}

.pagination a:hover {
  text-decoration: underline;
}

.pagination span {
  color: #a0aec0;
}

/* No customers message */
.no-customers {
  text-align: center;
  color: #718096;
  font-size: 1rem;
}



.header-with-button {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}


.prev-btn {
  background-color: #2563eb;       /* Blue-600 */
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 600;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(37, 99, 235, 0.4);
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
  font-size: 1rem;
}

.prev-btn:hover {
  background-color: #1d4ed8;       /* Blue-700 */
  box-shadow: 0 6px 10px rgba(29, 78, 216, 0.6);
}

.prev-btn:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.6);
}



</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\customer\emailService.blade.php ENDPATH**/ ?>