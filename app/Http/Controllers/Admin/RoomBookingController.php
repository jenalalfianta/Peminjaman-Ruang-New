<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
{
    public function index()
    {
        $roomBookings = RoomBooking::all();
        return view('admin.room_bookings.index', compact('roomBookings'));
    }

    public function create()
    {
        // Tampilkan formulir untuk membuat peminjaman ruangan baru
        return view('admin.room_bookings.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            // Atur validasi sesuai kebutuhan
        ]);

        // Simpan data peminjaman ruangan baru ke database
        RoomBooking::create([
            // Isi data peminjaman ruangan dari $request
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.room_bookings.index')->with('success', 'Peminjaman ruangan berhasil dibuat.');
    }

    // Fungsi update dan delete bisa diimplementasikan sesuai kebutuhan
}