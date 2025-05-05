@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Category</h3>

    <form action="/admin/categories/store" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="/admin/categories" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
