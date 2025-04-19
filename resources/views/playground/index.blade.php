<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Playground | iREX Admin</title>

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

                <!-- Playground Section -->
                <div class="container py-4">

                <form id="chat-form">
                    <input type="hidden" name="playground_id" id="playground_id" value="{{ $playgroundId ?? '' }}">

                    <div class="mb-3">
                        <label class="form-label" for="pg-prompt">Question</label>
                        <div class="d-flex">
                            <input type="text" name="pg-prompt" id="pg-prompt" placeholder="Type your message" class="form-control" required>
                            <button class="btn btn-success mx-2" type="submit">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="pg-result">Answer</label>
                        <textarea name="result" name="pg-result" id="pg-result" class="form-control" required readonly></textarea>
                    </div>
                </form>

                    <hr class="sidebar-divider">
                    <div class="container py-4">
                        <div class="row g-1">
                            @if ($playgrounds->total() === 0)
                                <p>You have not created any prompts yet.</p>
                            @else
                                @foreach($playgrounds as $playground)
                                    <div class="col-12">
                                        <div id="accordion">
                                            <div class="card shadow mb-4">
                                                <a class="card-header py-3" href="#" data-bs-toggle="collapse"
                                                   data-bs-target="#collapseUser{{$playground->playground_id}}"
                                                   data-bs-parent="#accordion" role="button" aria-expanded="false">
                                                    <h6 class="m-0 font-weight-bold text-primary">{{ $playground->created_at }}</h6>
                                                </a>

                                                @php
                                                    $last = $playground->inquiries->sortByDesc('created_at')->first();
                                                @endphp

                                                <div id="collapseUser{{ $playground->playground_id }}" class="collapse">
                                                    <div class="card-body">
                                                        <div class="tab-content" id="empTabContent">
                                                            <div class="tab-pane fade show active" id="created"
                                                                 role="tabpanel">
                                                                <p><strong>Last Inquiry Sent: {{ $last ? $last->created_at->diffForHumans() : 'No inquiries yet' }}</p>
                                                                <p><strong>Number of Inquiries: </strong> {{ $playground->inquiries_count }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ route('playground.show', $playground->playground_id) }}"
                                                               class="btn btn-sm btn-info mx-1">
                                                                <i class="bi bi-view-list"></i> View</a>

                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal-{{ $playground->playground_id }}">
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
                                        {{ $playgrounds->links() }}
                                    </div>
                            @endif
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

<!-- Include the Delete Modal -->
@foreach ($playgrounds as $playground)
    @include('playground.deleter', ['playground'=> $playground])
@endforeach

<!-- Bootstrap core JavaScript-->
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('dist/assets/js/sb-admin-2.js') }}"></script>
<script> const playgroundStoreRoute = "{{ route('playground.store') }}";</script>
<script src="{{ asset('dist/assets/js/chatform.js') }}"></script>

<!-- Page level plugins -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>

</html>
