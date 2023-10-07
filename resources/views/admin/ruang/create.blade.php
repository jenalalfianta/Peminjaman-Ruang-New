@extends('layouts.app')

@section('title', 'Buat Ruang Baru')

@section('content')
    <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        Buat Ruang Baru
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
                        <form method="POST" action="{{ route('ruang.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="kode_ruangan" class="form-label">Kode Ruangan:</label>
                                <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" >
                            </div>
                            <div class="mb-3">
                                <label for="nama_ruangan" class="form-label">Nama Ruangan:</label>
                                <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" >
                            </div>
                            <div class="mb-3">
                                <label for="lantai_ruangan" class="form-label">Lantai Ruangan:</label>
                                <input type="text" class="form-control" id="lantai_ruangan" name="lantai_ruangan">
                            </div>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas Ruangan:</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" >
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Ruangan:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="aktif" name="aktif" checked>
                                <label class="form-check-label" for="aktif">
                                    Aktif
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
    </div>
@endsection
