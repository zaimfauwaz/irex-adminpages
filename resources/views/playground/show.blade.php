@extends('layouts.adminshow')
@section('title', 'Playground Session Viewer | iREX Admin')

@section('content')

    {{--    Logic Section Here--}}
    <h5 class="card-title"><strong>Playground Session {{ $playground->playground_id }}</strong></h5>
    <h4>Inquiry History</h4>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Prompt</th>
                <th>Result</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($playground->inquiries as $inquiry)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $inquiry->prompt }}</td>
                    <td>{{ $inquiry->result }}</td>
                    <td>{{ $inquiry->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No inquiries found for this playground.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <a href="{{ route('playground.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Return</a>
    </div>
@endsection
