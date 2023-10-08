@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Selamat datang, {{ Auth::user()->name }}</h1>
</div>
@endsection
