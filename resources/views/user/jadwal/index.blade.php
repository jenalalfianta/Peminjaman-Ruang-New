@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('custom')
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href='{{asset('assets/template/sbadmin2/vendor/bootstrap')}}' rel='stylesheet' />
    <link href='{{asset('assets/library/fullcalendar-5.11.5/lib/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/library/fullcalendar-5.11.5/lib/main.css')}}' rel='stylesheet' />
    <script src='{{asset('assets/library/fullcalendar-5.11.5/lib/main.js')}}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
        });
        calendar.render();
        });
  </script>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">

        <!-- FullCalendar (70%) -->
        <div class="col-md-8">
            <div id='calendar'></div>
        </div>

        <!-- Kotak Informasi (30%) -->
        <div class="col-md-4 border rounded p-3">
            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif
            <h4>Nama Kegiatan</h4>
            <p>Nama User Peminjam: {{ Auth::user()->name }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ruangan A</td>
                        <td>08:00 AM</td>
                        <td>10:00 AM</td>
                    </tr>
                    <!-- Tambah baris sesuai kebutuhan -->
                </tbody>
            </table>
            <p>Keterangan: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>


    </div>
</div>
@endsection
