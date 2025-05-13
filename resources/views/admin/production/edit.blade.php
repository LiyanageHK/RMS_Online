@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('admin/production/update/' . $product->id) }}" enctype="multipart/form-data" id="productForm">
        @csrf

        <div class="mb-3">
            <label>Product Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Product Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" {{ old('status', $product->status) ? 'checked' : '' }}>
                <label class="form-check-label" for="statusSwitch">For Sale</label>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Size Multipliers and Prices <span class="text-danger">*</span></label>
            <div class="row">
                <div class="col-md-4">
                    <label for="small">Small</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="small" id="small" class="form-control @error('small') is-invalid @enderror" value="{{ old('small', $product->small) }}" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="small_price" class="form-control @error('small_price') is-invalid @enderror" value="{{ old('small_price', $product->small_price) }}" required>
                    </div>
                    @error('small')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('small_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="medium">Medium</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="medium" id="medium" class="form-control @error('medium') is-invalid @enderror" value="{{ old('medium', $product->medium) }}" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="medium_price" class="form-control @error('medium_price') is-invalid @enderror" value="{{ old('medium_price', $product->medium_price) }}" required>
                    </div>
                    @error('medium')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('medium_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="large">Large</label>
                    <div class="input-group mb-2">
                        <input type="number" step="0.5" name="large" id="large" class="form-control @error('large') is-invalid @enderror" value="{{ old('large', $product->large) }}" required>
                        <span class="input-group-text">x</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" step="0.01" name="large_price" class="form-control @error('large_price') is-invalid @enderror" value="{{ old('large_price', $product->large_price) }}" required>
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
            <label>Existing Images</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach($images as $img)
                    <div class="position-relative">
                        <img src="{{ asset('uploads/products/' . $img->image) }}" style="width:100px;" class="rounded shadow-sm">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="removeExistingImage('{{ $img->id }}')">X</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label>Add New Images</label>
            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple onchange="previewImages(event)">
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-2"></div>
            <div id="uploadedImagesCancel" class="mt-3"></div>
        </div>

        <div class="mb-3">
            <label>Select Items & Quantities <span class="text-danger">*</span></label>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Select</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="item_ids[]" value="{{ $item->id }}" class="item-checkbox"
                                    {{ isset($selected[$item->id]) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <input type="number" name="quantities[]" class="form-control quantity-input" placeholder="Qty" min="1"
                                    value="{{ $selected[$item->id] ?? '' }}" {{ isset($selected[$item->id]) ? '' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="itemError" class="text-danger d-none">Please select at least one item</div>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('productForm');
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const itemError = document.getElementById('itemError');

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

    function previewImages(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreview');
        const cancelContainer = document.getElementById('uploadedImagesCancel');
        previewContainer.innerHTML = '';
        cancelContainer.innerHTML = '';

        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrapper = document.createElement('div');
                imgWrapper.classList.add('position-relative', 'me-2', 'mb-2');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.classList.add('rounded', 'shadow');

                const cancelButton = document.createElement('button');
                cancelButton.type = 'button';
                cancelButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                cancelButton.textContent = 'X';
                cancelButton.onclick = function() {
                    imgWrapper.remove();
                    const input = document.querySelector('input[name="images[]"]');
                    input.value = '';
                };

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(cancelButton);
                previewContainer.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeExistingImage(imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: `/admin/production/image/delete/${imageId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        alert('Image deleted successfully.');
                        location.reload();
                    } else {
                        alert('Failed to delete the image.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the image.');
                }
            });
        }
    }
</script>
@endsection


