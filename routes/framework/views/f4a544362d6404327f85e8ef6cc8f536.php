<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Authentication Data Test</h3>
                </div>
                <div class="card-body">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="mb-4">
                            <h4>User Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td><?php echo e(Auth::id()); ?></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo e(Auth::user()->name); ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo e(Auth::user()->email); ?></td>
                                </tr>
                                <tr>
                                    <th>Email Verified</th>
                                    <td><?php echo e(Auth::user()->email_verified_at ? 'Yes' : 'No'); ?></td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td><?php echo e(Auth::user()->created_at); ?></td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td><?php echo e(Auth::user()->updated_at); ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>Auth Methods</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Auth::check()</th>
                                    <td><?php echo e(Auth::check() ? 'true' : 'false'); ?></td>
                                </tr>
                                <tr>
                                    <th>Auth::guest()</th>
                                    <td><?php echo e(Auth::guest() ? 'true' : 'false'); ?></td>
                                </tr>
                                <tr>
                                    <th>Auth::viaRemember()</th>
                                    <td><?php echo e(Auth::viaRemember() ? 'true' : 'false'); ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>Session Data</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Session ID</th>
                                    <td><?php echo e(session()->getId()); ?></td>
                                </tr>
                                <tr>
                                    <th>CSRF Token</th>
                                    <td><?php echo e(csrf_token()); ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>All User Attributes</h4>
                            <table class="table table-bordered">
                                <?php $__currentLoopData = Auth::user()->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($key); ?></th>
                                        <td><?php echo e(is_array($value) ? json_encode($value) : $value); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            You are not authenticated. Please log in to see authentication data.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\auth-test.blade.php ENDPATH**/ ?>