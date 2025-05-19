<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Create Product</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

   

    <form method="POST" action="<?php echo e(url('admin/production/store')); ?>" enctype="multipart/form-data" id="productForm">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Product Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name')); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description')); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Images (first = main) <span class="text-danger">*</span></label>
            <input type="file" name="images[]" class="form-control <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" multiple required id="imageInput">
            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="preview-container mt-3">
                <div id="imagePreview" class="row g-3"></div>
            </div>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" <?php echo e(old('status', true) ? 'checked' : ''); ?>>
            <label class="form-check-label" for="statusSwitch">For Sale</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Category</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Sizes and Prices <span class="text-danger">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <label for="small" class="form-label">Small</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="small" id="small" class="form-control <?php $__errorArgs = ['small'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('small', 1)); ?>" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="small_price" class="form-control <?php $__errorArgs = ['small_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('small_price')); ?>" required>
                    </div>
                    <?php $__errorArgs = ['small'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['small_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-4">
                    <label for="medium" class="form-label">Medium</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="medium" id="medium" class="form-control <?php $__errorArgs = ['medium'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('medium', 2)); ?>" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="medium_price" class="form-control <?php $__errorArgs = ['medium_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('medium_price')); ?>" required>
                    </div>
                    <?php $__errorArgs = ['medium'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['medium_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-4">
                    <label for="large" class="form-label">Large</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="large" id="large" class="form-control <?php $__errorArgs = ['large'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('large', 3)); ?>" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="large_price" class="form-control <?php $__errorArgs = ['large_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('large_price')); ?>" required>
                    </div>
                    <?php $__errorArgs = ['large'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['large_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Items & Quantities <span class="text-danger">*</span></label>
            <?php $__errorArgs = ['item_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Select</th>
                        <th>Item Name</th>
                        <th>Quantity (g)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="item_ids[]" value="<?php echo e($item->id); ?>" class="item-checkbox">
                        </td>
                        <td><?php echo e($item->name); ?></td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control quantity-input <?php $__errorArgs = ['quantities.'.$index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Qty" min="1" >
                            <?php $__errorArgs = ['quantities.'.$index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div id="itemError" class="text-danger d-none">
                <i class="fas fa-exclamation-circle me-2"></i>
                Please select at least one item
            </div>
        </div>

        
    <div class="d-flex justify-content-between">
        <a href="<?php echo e(url('/admin/production')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
        <button type="submit" class="btn btn-success px-4">Create Product</button>
    </div>

    </form>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    let selectedFiles = [];

    function previewImages(event) {
        const files = event.target.files;
        if (!files || files.length === 0) return;

        const previewContainer = document.getElementById('imagePreview');
        // Clear previous previews
        previewContainer.innerHTML = '';
        selectedFiles = Array.from(files);

        // Process each file
        selectedFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-3 col-sm-4 col-6';

                const previewDiv = document.createElement('div');
                previewDiv.className = 'preview-item position-relative';
                previewDiv.style.height = '200px';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid rounded shadow';
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';

                const cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 m-2';
                cancelBtn.innerHTML = '<i class="fas fa-times"></i>';
                cancelBtn.style.width = '30px';
                cancelBtn.style.height = '30px';
                cancelBtn.style.padding = '0';
                cancelBtn.style.borderRadius = '50%';
                cancelBtn.style.zIndex = '1';
                cancelBtn.onclick = function() {
                    removeImage(index);
                };

                previewDiv.appendChild(img);
                previewDiv.appendChild(cancelBtn);
                colDiv.appendChild(previewDiv);
                previewContainer.appendChild(colDiv);
            };

            reader.onerror = function() {
                console.error('Error reading file:', file.name);
            };

            reader.readAsDataURL(file);
        });
    }

    function removeImage(index) {
        if (index >= 0 && index < selectedFiles.length) {
            selectedFiles.splice(index, 1);
            
            // Create a new DataTransfer object
            const dataTransfer = new DataTransfer();
            
            // Add remaining files to the DataTransfer object
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            
            // Update the file input
            const fileInput = document.getElementById('imageInput');
            fileInput.files = dataTransfer.files;
            
            // Trigger the preview again
            previewImages({ target: { files: dataTransfer.files } });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('productForm');
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const itemError = document.getElementById('itemError');
        const imageInput = document.getElementById('imageInput');

        // Add event listener for image input
        if (imageInput) imageInput.addEventListener('change', previewImages);

        // Enable/disable quantity inputs based on checkbox state
        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                quantityInputs[index].disabled = !this.checked;
                if (!this.checked) {
                    quantityInputs[index].value = '';
                }
            });
        });

        // Form validation
        form.addEventListener('submit', function(e) {
            let hasSelectedItem = false;
            checkboxes.forEach((checkbox, idx) => {
                if (checkbox.checked) {
                    hasSelectedItem = true;
                    // Make sure quantity is filled for selected items
                    if (!quantityInputs[idx].value) {
                        e.preventDefault();
                        quantityInputs[idx].classList.add('is-invalid');
                    } else {
                        quantityInputs[idx].classList.remove('is-invalid');
                    }
                } else {
                    quantityInputs[idx].classList.remove('is-invalid');
                }
            });
            if (!hasSelectedItem) {
                e.preventDefault();
                itemError.classList.remove('d-none');
            } else {
                itemError.classList.add('d-none');
            }
        });

        // Price validation
        const priceInputs = document.querySelectorAll('input[name$="_price"]');
        priceInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = 0;
                }
            });
        });

        // Size multiplier validation
        const sizeInputs = document.querySelectorAll('input[name="small"], input[name="medium"], input[name="large"]');
        sizeInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0.5) {
                    this.value = 0.5;
                }
            });
        });
    });
</script>

<style>
.preview-container {
    background-color: #f8f9fa;
    border: 1px dashed #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    min-height: 200px;
}

.preview-item {
    transition: transform 0.2s;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    overflow: hidden;
}

.preview-item:hover {
    transform: scale(1.02);
}

.preview-item img {
    border: none;
}

.preview-item .btn-danger {
    background-color: rgba(220, 53, 69, 0.9);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-item .btn-danger:hover {
    background-color: #dc3545;
}

.preview-item .btn-danger i {
    font-size: 0.875rem;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\admin\production\create.blade.php ENDPATH**/ ?>