@extends('layouts.adminshow')
@section('title', 'Employee Management Viewer | iREX Admin')

@section('content')
    <h5 class="card-title"><strong>{{ $employee->name }}</strong></h5>
    <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
    <p><strong>Username:</strong> {{ $employee->username }}</p>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Created:</strong> {{$employee->created_at}}</p>
    <p><strong>Last Modified:</strong> {{$employee->updated_at}}</p>
    {!! $employee->admin_status !!}
    <div class="d-flex justify-content-end">
        <a href="{{ route('adminemp.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Return</a>
    </div>
@endsection
