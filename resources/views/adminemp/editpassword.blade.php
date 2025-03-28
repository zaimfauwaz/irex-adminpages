@extends('layouts.adminedit')
@section('title','Employee Management Editor | iREX Admin')
@section('alias', 'Employee')

@section('content')
    <form action="{{ route('adminemp.updatepassword', $adminemp->employee_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $adminemp->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $adminemp->username }}" required readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        @error('password')
        <div class="alert alert-danger text-red-100">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Change Password</button>
        <a href="{{ route('adminemp.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
@endsection
