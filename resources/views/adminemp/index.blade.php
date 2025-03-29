@php use Illuminate\Support\Facades\Auth; @endphp
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
                @include('components.topbar_s')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Log Include -->
                    <div class="container py-4">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('adminemp.create') }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-plus"></i> New Employee
                                </a>
                            </div>
                        <div class="row g-1">

                            @if ($employees->count() > 0)
                                @foreach($employees as $emp)
                                    <div class="col-12">
                                        <div id="accordion">
                                            <div class="card shadow mb-4">
                                                <a class="card-header py-3" href="#" data-bs-toggle="collapse"
                                                   data-bs-target="#collapseUser{{$emp->employee_id}}"
                                                   data-bs-parent="#accordion" role="button" aria-expanded="false">
                                                    <h6 class="m-0 font-weight-bold text-primary">{{ $emp->name }}</h6>
                                                </a>
                                                <div id="collapseUser{{$emp->employee_id}}" class="collapse">
                                                    <div class="card-body">

                                                        <div class="tab-content" id="empTabContent">
                                                            <div class="tab-pane fade show active" id="username"
                                                                 role="tabpanel">
                                                                <p><strong>Username: </strong> {{ $emp->username }}</p>
                                                            </div>
                                                            <div class="tab-pane fade show active" id="email"
                                                                 role="tabpanel">
                                                                <p><strong>Email: </strong> {{ $emp->email }}</p>
                                                            </div>
                                                        </div>

                                                        {!! $emp->emp_status !!}
                                                        {!! $emp->admin_status !!}

                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ route('adminemp.show', $emp->employee_id) }}"
                                                               class="btn btn-sm btn-info mx-1">
                                                                <i class="bi bi-view-list"></i> View</a>
                                                            <a href="{{ route('adminemp.edit', $emp->employee_id) }}"
                                                               class="btn btn-sm btn-warning mx-2">
                                                                <i class="bi bi-pencil"></i> Edit</a>
                                                            <a href="{{ route('adminemp.editpassword', $emp->employee_id) }}"
                                                               class="btn btn-sm btn-warning mx-2">
                                                                <i class="bi bi-key"></i> Change Password</a>

                                                            @php
                                                                $loggedInUsername = Auth::user()->username;
                                                            @endphp

                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal-{{ $emp->employee_id }}"
                                                                    @if($loggedInUsername == $emp->username) disabled @endif>
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $employees->links() }}
                                </div>
                            @endif
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

    <!-- Include the Delete Modal -->
    @foreach ($employees as $emp)
        @include('adminemp.deleter', ['emp'=> $emp])
    @endforeach

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
