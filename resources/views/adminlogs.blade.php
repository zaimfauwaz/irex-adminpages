<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logs | iREX Admin</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
          type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dist/assets/css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- SideBar Section -->
    @include('components.adminbar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Search Topbar Section -->
            @include('components.topbar_ns')

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Log Include -->
                <div class="container py-4">
                    <div class="row g-1">
                        @if (!empty($logs))
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
                                    } elseif ($log->action == 'Logout ChatSession') {
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


                <!-- Create cards to display list of logs from MySQL database -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Zaim Zain 2025</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Form Related Contents -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

<!-- Include the Logout Modal -->
@include('components.logoutmodal')

<!-- Bootstrap core JavaScript-->
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('dist/assets/js/sb-admin-2.js') }}"></script>

<!-- Page level plugins -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>

</html>
