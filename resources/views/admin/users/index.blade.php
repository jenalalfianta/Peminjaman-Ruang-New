@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Daftar User</h1>

        <form action="{{ route('admin.users.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari user..." name="keyword" value="{{ old('keyword', $keyword ?? '') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aktif</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->isActive ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td>{{ $user->phoneNumber }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
