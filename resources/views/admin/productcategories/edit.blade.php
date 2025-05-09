@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="/admin/productcategories/update/{{ $category->id }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="/admin/categories" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
