@extends('layouts.app')

@section('title', 'Daftar Ruangan')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Ruangan</h1>

        <form action="{{ route('admin.ruang.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari ruangan..." name="keyword">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <a href="{{ route('ruang.create') }}" class="btn btn-primary mb-3">Tambah Ruang</a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Kode Ruang</th>
                    <th scope="col">Nama Ruang</th>
                    <th scope="col">Lantai Ruang</th>
                    <th scope="col">Kapasitas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ruang as $r)
                <tr>
                    <td>{{ $r->kode_ruangan }}</td>
                    <td>{{ $r->nama_ruangan }}</td>
                    <td>{{ $r->lantai_ruangan }}</td>
                    <td>{{ $r->kapasitas }}</td>
                    <td>
                        <a href="{{ route('ruang.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('ruang.destroy', $r->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus ruang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
