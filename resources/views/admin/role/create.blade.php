@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Add New Role</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role Name</label>
                            <input type="text" name="role" id="role" class="form-control" value="{{ old('role') }}" required>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                      
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
