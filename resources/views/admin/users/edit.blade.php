@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header">
                Edit Pengguna
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
                <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role">
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="isActive" name="isActive" {{ old('isActive', $user->isActive) ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="isActive">Aktif</label>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address">{{ old('address', $user->address) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="organization" class="form-label">Unit/Organisasi</label>
                        <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization', $user->organization) }}">
                    </div>
                    <div class="mb-3">
                        <label for="jobTitle" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jobTitle" name="jobTitle" value="{{ old('jobTitle', $user->jobTitle) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
