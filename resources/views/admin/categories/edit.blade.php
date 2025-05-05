@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Category</h3>

    <form action="/admin/categories/update/{{ $category->id }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/admin/categories" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
