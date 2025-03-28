@extends('layouts.adminedit')
@section('title','Employee Management Editor | iREX Admin')
@section('alias', 'Employee')

@section('content')
{{--    In this content section, only add the form part--}}
    <form action="{{ route('adminemp.update', $adminemp->employee_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $adminemp->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $adminemp->username }}" required>
        </div>
        @error('username')
        <div class="alert alert-danger text-red-100">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $adminemp->email }}" required>
        </div>
        @error('email')
        <div class="alert alert-danger text-red-100">{{ $message }}</div>
        @enderror


        <div class="mb-3">
            <label class="form-label">Employment Status</label>
            <select name="is_active" class="form-control">
                <option value="1" @selected(old('is_active', $adminemp->is_active) == 1)>Active</option>
                <option value="0" @selected(old('is_active', $adminemp->is_active) == 0)>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Admin Status</label>
            <select name="is_admin" class="form-control">
                <option value="1" @selected(old('is_admin', $adminemp->is_admin) == 1)>Administrator</option>
                <option value="0" @selected(old('is_admin', $adminemp->is_admin) == 0)>CRM Worker</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('adminemp.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
