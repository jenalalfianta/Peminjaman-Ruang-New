@extends('layouts.app')

@section('style')
    .bg-register-custom {
        background: url("{{ asset('assets/template/sbadmin2/img/parkir-upi-min.jpg') }}");
        background-position: center;
        background-size: cover;
    }
@endsection

@section('title', 'Reset Password')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-register-custom"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                    <p class="mb-4">Masukkan kata sandi baru untuk mereset kata sandi Anda.</p>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="New Password" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPasswordConfirm" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    @if(session('status'))
                                        <div class="alert alert-success mt-2" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection