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
                        <form method="POST" action="{{ route('room.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Ruang</label>
                                <input type="text" class="form-control" id="code" name="code" >
                            </div>
                            <div class="mb-3">
                                <label for="roomName" class="form-label">Nama Ruang</label>
                                <input type="text" class="form-control" id="roomName" name="roomName" >
                            </div>
                            <div class="mb-3">
                                <label for="floor" class="form-label">Lantai Ruang</label>
                                <input type="text" class="form-control" id="floor" name="floor">
                            </div>
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Kapasitas Ruang</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" >
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Ruang</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="isActive" name="isActive" checked>
                                <label class="form-check-label" for="isActive">
                                    Aktif
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
    </div>
@endsection
