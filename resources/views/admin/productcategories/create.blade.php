@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Create New Category</h2>

   

    <form action="/admin/productcategories/store" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="/admin/categories" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
