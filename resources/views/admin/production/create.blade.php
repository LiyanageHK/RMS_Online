@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Create Product</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   

    <form method="POST" action="{{ url('admin/production/store') }}" enctype="multipart/form-data" id="productForm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Product Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Product Images (first = main) <span class="text-danger">*</span></label>
            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple required id="imageInput">
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="preview-container mt-3">
                <div id="imagePreview" class="row g-3"></div>
            </div>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" {{ old('status', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="statusSwitch">For Sale</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Product Sizes and Prices <span class="text-danger">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <label for="small" class="form-label">Small</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="small" id="small" class="form-control @error('small') is-invalid @enderror" value="{{ old('small', 1) }}" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="small_price" class="form-control @error('small_price') is-invalid @enderror" value="{{ old('small_price') }}" required>
                    </div>
                    @error('small')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('small_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="medium" class="form-label">Medium</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="medium" id="medium" class="form-control @error('medium') is-invalid @enderror" value="{{ old('medium', 2) }}" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="medium_price" class="form-control @error('medium_price') is-invalid @enderror" value="{{ old('medium_price') }}" required>
                    </div>
                    @error('medium')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('medium_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="large" class="form-label">Large</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="large" id="large" class="form-control @error('large') is-invalid @enderror" value="{{ old('large', 3) }}" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="large_price" class="form-control @error('large_price') is-invalid @enderror" value="{{ old('large_price') }}" required>
                    </div>
                    @error('large')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('large_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Items & Quantities <span class="text-danger">*</span></label>
            @error('item_ids')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
            @enderror
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Select</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="item_ids[]" value="{{ $item->id }}" class="item-checkbox">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control quantity-input @error('quantities.'.$index) is-invalid @enderror" placeholder="Qty" min="1" >
                            @error('quantities.'.$index)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="itemError" class="text-danger d-none">
                <i class="fas fa-exclamation-circle me-2"></i>
                Please select at least one item
            </div>
        </div>

        
    <div class="d-flex justify-content-between">
        <a href="{{ url('/admin/production') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
        <button type="submit" class="btn btn-success px-4">Create Product</button>
    </div>

    </form>
</div>

@section('scripts')
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
        imageInput.addEventListener('change', previewImages);

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
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    hasSelectedItem = true;
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
@endsection

@endsection
