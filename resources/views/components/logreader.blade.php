<div class="container py-4">
    <div class="row g-1">
        @if ($logs->count() > 0)
            @foreach($logs as $log)
                @php
                    $cardColor = 'border-left-info';
                    $textColor = 'text-info';

                    if ($log->action == 'Login Success') {
                        $cardColor = 'border-left-success';
                        $textColor = 'text-success';
                    } elseif ($log->action == 'Login Failed') {
                        $cardColor = 'border-left-danger';
                        $textColor = 'text-danger';
                    } elseif ($log->action == 'Logout Session') {
                        $cardColor = 'border-left-warning';
                        $textColor = 'text-warning';
                    }
                @endphp
                <div class="col-12">
                    <div class="card {{ $cardColor }} w-100 mb-3">
                        <div class="card-body">
                            <h5 class="card-title {{ $textColor }}"><b>{{ $log->action }}</b></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-xs"><b>{{ $log->method }}</b></h6>
                            <p class="card-text text-sm">{{ $log->description }}</p>
                            <p class="card-text text-sm"> {{ $log->employee->name ?? 'Anonymous User' }}</p>
                            <p class="card-text text-xs"> {{ $log->writer }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-3">
                {{ $logs->links() }}
            </div>
        @else
            <p>No logs found.</p>
        @endif
    </div>
</div>
