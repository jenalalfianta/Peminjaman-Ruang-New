<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ...tag-tag meta lainnya -->
    <title>@yield('title')</title>
    <!-- Link CSS dan font yang umum untuk semua halaman -->
    <link href="{{ asset('assets/template/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/template/sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        {{ isset($style) ? $style : '' }}
    </style>
</head>

<body class="bg-gradient-light">

    <!-- ... Konten dari halaman -->
    @guest
        @yield('content')
    @else
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
    @endguest

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/template/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/template/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('assets/template/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
</body>

</html>
