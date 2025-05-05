@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Item</h2>
    <form method="POST" action="{{ url('admin/items/store') }}">
        @csrf
        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Price (Rs.)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
