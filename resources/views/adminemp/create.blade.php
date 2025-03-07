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
                            <h5 class="card-title"><strong>Create New Employee</strong></h5>
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
