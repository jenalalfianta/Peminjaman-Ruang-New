@extends('layouts.app')

@section('style')
    .bg-register-custom {
        background: url("{{ asset('assets/template/sbadmin2/img/lift-fpbs-min.jpg') }}");
        background-position: center;
        background-size: cover;
    }
@endsection

@section('title', 'Forgot Password')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <!-- Menampilkan pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan pesan error -->
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-register-custom"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Lupa Password?</h1>
                                    <p class="mb-4">Kami mengerti, hal-hal tak terduga bisa terjadi. Masukkan alamat email Anda di bawah ini, dan kami akan mengirimkan tautan untuk mereset kata sandi Anda!</p>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..."
                                            name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Buat Akun!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Sudah memiliki akun? Masuk!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
