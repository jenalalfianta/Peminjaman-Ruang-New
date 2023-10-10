
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistem Peminjaman dan Penjadwalan Ruang FPBS</title>
        <!-- Favicon-->
        <link rel="icon" type="image/png" href="{{ asset('assets/template/sbadmin2/img/favicon-16x16.png') }}" sizes="16x16">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/template/startbootstrap/') }}/css/styles.css" rel="stylesheet" />
        <!-- Font Awesome-->
        <link href="{{ asset('assets/template/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
            <div class="container px-5">
                <a class="navbar-brand text-light" href="#">FPBS UPI</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link text-light active" href="{{route('beranda')}}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="#">Jadwal Ruang</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{route('register')}}">Register</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{route('login')}}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-primary py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center my-5">
                            <h1 class="display-5 fw-bolder text-white mb-2">Peminjaman dan Penjadwalan Ruang FPBS</h1>
                            <p class="lead text-white-50 mb-4">Sebelum melakukan peminjaman ruang, silakan baca dengan seksama syarat dan ketentuan peminjaman ruang <a class="text-light text-decoration-none" href="#">disini</a></p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Jadwal Ruang</a>
                                <a class="btn btn-outline-light btn-lg px-4" href="#">Pinjam Ruang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Features section-->
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                        <h2 class="h4 fw-bolder">Buat Akun</h2>
                        <p>Untuk melakukan peminjaman atau sewa, pemohon wajib melakukan pendaftaran akun.</p>
                        <a class="text-decoration-none" href="#">
                            Selengkapnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                        <h2 class="h4 fw-bolder">Syarat dan Ketentuan</h2>
                        <p>Pahami syarat dan ketentuan peminjaman atau sewa ruang untuk mempercepat proses persetujuan peminjaman.</p>
                        <a class="text-decoration-none" href="#">
                            Selengkapnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                        <h2 class="h4 fw-bolder">Biaya Sewa</h2>
                        <p>.....</p>
                        <a class="text-decoration-none" href="#">
                            Selengkapnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-2 bg-primary">
            <div class="container justify-content-center px-5">
                <p class="m-0 text-center text-white-50">&copy; Fakultas Pendidikan Bahasa dan Sastra 2023<br>Crafted with <i class="fas fa-heart fa-xs"></i> by <a class="text-light text-decoration-none" href="#"> Jenal Alfianta Bangun</a></p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/template/startbootstrap/') }}/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
