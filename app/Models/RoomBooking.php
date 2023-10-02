<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    use HasFactory;

    protected $table = 'room_bookings';

    protected $fillable = [
        'user_id',
        'room_id',
        'start_time',
        'end_time',
        'status',
        'izin_peminjaman_path',
        'izin_kegiatan_path',
        'keterangan',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan Room
    public function room()
    {
        return $this->belongsTo(Ruang::class, 'kode_ruangan');
    }

    // Relasi dengan BookingRoom
    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class, 'booking_id');
    }

    // Relasi dengan BookingCancellation
    public function bookingCancellations()
    {
        return $this->hasMany(BookingCancellation::class, 'booking_id');
    }
}
