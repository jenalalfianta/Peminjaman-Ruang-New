<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;

class BookingRoomUserController extends Controller
{
    // Mengambil Ruangan yang Dipesan untuk Pemesanan Tertentu
    public function getRoomsByBooking($bookingId)
    {
        // Mengambil daftar ruangan yang terkait dengan pemesanan tertentu
        $rooms = BookingRoom::where('booking_id', $bookingId)
            ->join('ruang', 'booking_rooms.room_id', '=', 'ruang.id')
            ->select('ruang.nama_ruangan', 'ruang.kode_ruangan')
            ->get();

        return response()->json(['rooms' => $rooms]);
    }

    // Mengambil Pemesanan Ruangan untuk Pengguna Tertentu
    public function getBookingsByUser($userId)
    {
        // Mengambil daftar pemesanan ruangan oleh pengguna berdasarkan ID pengguna
        $bookings = BookingRoom::whereHas('booking', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return response()->json(['bookings' => $bookings]);
    }
}
