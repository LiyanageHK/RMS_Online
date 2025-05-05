@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Role</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="roleForm" action="{{ route('admin.role.update', $role->id) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="POST">

        <div class="mb-3">
            <label for="role" class="form-label">Role Name</label>
            <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $role->role) }}" required>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $role->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Permission Toggles -->
        <div class="mb-3">
            <h5>Permissions</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="inv" id="inv" 
                            {{ old('inv', $permissions->inv) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inv">Inventory Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="cus" id="cus" 
                            {{ old('cus', $permissions->cus) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="cus">Customer Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="order" id="order" 
                            {{ old('order', $permissions->order) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="order">Order Center</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="deli" id="deli" 
                            {{ old('deli', $permissions->deli) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="deli">Delivery Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="emp" id="emp" 
                            {{ old('emp', $permissions->emp) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="emp">Employee Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="acc" id="acc" 
                            {{ old('acc', $permissions->acc) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="acc">Access Management Center</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input permission-toggle" type="checkbox" name="pro" id="pro" 
                            {{ old('pro', $permissions->pro) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pro">Product Management</label>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Back to Roles</a>
    </form>
</div>
@endsection