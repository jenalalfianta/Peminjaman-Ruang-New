@extends('layouts.app')

@section('title', 'Daftar Transaksi Pemesanan')

@section('content')
<div class="container mt-5">
    <h1>Daftar Jadwal Ruangan</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Pengguna</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Daftar Ruangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->start }}</td>
                    <td>{{ $transaction->end }}</td>
                    <td>
                        <ul>
                            @foreach($transaction->bookingRooms as $bookingRoom)
                                <li>{{ $bookingRoom->ruang->nama_ruangan }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $transaction->status }}</td>
                    <td>
                        @if($transaction->status == 'pending')
                            <form action="{{ route('admin.jadwal.konfirmasi', $transaction->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </form>
                        @else
                            Sudah Dikonfirmasi
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
