@extends('layouts.admincreate')
@section('title','Employee Management Creator | iREX Admin')
@section('alias', 'Employee')

@section('content')
    <form action="{{ route('adminemp.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        @error('username')
            <div class="alert alert-danger text-red-100">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        @error('email')
            <div class="alert alert-danger text-red-100">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        @error('password')
            <div class="alert alert-danger text-red-100">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Employment Status</label>
            <select name="is_active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Admin Status</label>
            <select name="is_admin" class="form-control">
                <option value="0">CRM Worker</option>
                <option value="1">Administrator</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('adminemp.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection
