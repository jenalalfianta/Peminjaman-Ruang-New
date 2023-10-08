@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="mb-4">Selamat datang, {{ Auth::user()->name }}</h1>
</div>

@endsection
