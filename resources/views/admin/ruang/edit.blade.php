@extends('layouts.app')

@section('title', 'Edit Ruang')

@section('content')
    <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        Edit Ruang
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
                        <form method="POST" action="{{ route('room.update', $ruang->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Ruang:</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{ $ruang->code }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="roomName" class="form-label">Nama Ruang:</label>
                                <input type="text" class="form-control" id="roomName" name="roomName"
                                    value="{{ $ruang->roomName }}" >
                            </div>
                            <div class="mb-3">
                                <label for="floor" class="form-label">Lantai Ruang:</label>
                                <input type="text" class="form-control" id="floor" name="floor"
                                    value="{{ $ruang->floor }}" >
                            </div>
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Kapasitas Ruang:</label>
                                <input type="number" class="form-control" id="capacity" name="capacity"
                                    value="{{ $ruang->capacity }}" >
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Ruang:</label>
                                <textarea class="form-control" id="description" name="description">{{ $ruang->description }}</textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="isActive" name="isActive" {{ $ruang->isActive ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Aktif
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
    </div>
@endsection
