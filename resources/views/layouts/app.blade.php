<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ...tag-tag meta lainnya -->
    <link rel="icon" type="image/png" href="{{ asset('assets/template/sbadmin2/img/favicon-16x16.png') }}" sizes="16x16">
    <title>@yield('title')</title>
    <!-- Link CSS dan font yang umum untuk semua halaman -->
    <link href="{{ asset('assets/template/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/template/sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        @yield('style');
    </style>
</head>

<body class="bg-gradient-light">
    <!-- ... Konten dari halaman -->
    @guest
        <!-- Tampilkan pesan kesalahan jika ada -->
        @if($errors->has('error'))
        <div class="alert alert-danger mt-3">
            {{ $errors->first('error') }}
        </div>
        @endif

        @yield('content')
    @else
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('partials.footer')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logoutForm').addEventListener('submit', function (e) {
            var confirmLogout = confirm('Apakah Anda yakin ingin logout?');
            if (!confirmLogout) {
                e.preventDefault(); // Mencegah form untuk submit
            }
        });
    </script>
    @endguest
    <!-- ...script tags lainnya -->

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/template/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/template/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('assets/template/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/template/sbadmin2/js/sb-admin-2.min.js') }}"></script>

    <!-- Custom JS-->

</body>

</html>
