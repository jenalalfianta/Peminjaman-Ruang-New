@extends('layouts.app')

@section('title', 'Buat User Baru')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header">
                Buat User Baru
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" >
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option selected value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="organization" class="form-label">Unit/Organisasi</label>
                        <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization') }}">
                    </div>
                    <div class="mb-3">
                        <label for="job_title" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
