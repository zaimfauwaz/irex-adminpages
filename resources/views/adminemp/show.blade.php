<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Employees | iREX Admin</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"
          type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $employee->name }}</strong></h5>
                            <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                            <p><strong>Username:</strong> {{ $employee->username }}</p>
                            <p><strong>Email:</strong> {{ $employee->email }}</p>
                            <p><strong>Created:</strong> {{$employee->created_at}}</p>
                            <p><strong>Last Modified:</strong> {{$employee->updated_at}}</p>
                            {!! $employee->emp_status !!}
                            {!! $employee->admin_status !!}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('adminemp.index') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-arrow-left-circle"></i> Return</a>
                            </div>
                        </div>
                    </div>
                </div>


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
