@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Item</h2>
    <form method="POST" action="{{ url('admin/items/update/'.$item->id) }}">
        @csrf
        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Price (Rs.)</label>
            <input type="number" name="price" step="0.01" value="{{ $item->price }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
