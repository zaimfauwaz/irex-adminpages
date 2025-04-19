<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Chatbox')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="{{asset('dist/assets/css/chatbox.css')}}" rel="stylesheet" />
    <link href="{{ asset('dist/assets/css/sb-crm-2.css') }}" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- SideBar Section -->
    @include('components.crmbar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Search Topbar Section -->
            @include('components.topbar_ns')


            <!-- Begin Page Content -->
            <div class="container-fluid vh-100"> <!-- Full height container -->
                <div class="row h-100"> <!-- Full height row -->
                    <div class="col-lg-12 d-flex flex-column h-75"> <!-- Full height column -->
                        <div class="card chat-app flex-grow-1 d-flex flex-column"> <!-- Card with flex layout -->
                            <div id="plist" class="people-list">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                                @yield('people')
                            </div>
                            <div class="chat flex-grow-1 d-flex flex-column"> <!-- Chat section with flex layout -->
                                <div class="chat-header clearfix">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @yield('owner')
                                        </div>
                                        <div class="col-lg-6 hidden-sm text-right">
                                            <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-history overflow-auto flex-grow-1"> <!-- Make chat history scrollable -->
                                    @yield('history')
                                </div>
                                <div class="chat-message clearfix">
                                    <div class="input-group mb-0">
                                        <input type="text" class="form-control" placeholder="Enter text here...">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-send"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>

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
