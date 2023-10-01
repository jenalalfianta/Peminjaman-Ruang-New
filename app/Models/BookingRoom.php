<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory;

    protected $table = 'booking_rooms';

    protected $fillable = [
        'booking_id',
        'room_id',
    ];

    // Relasi dengan RoomBooking
    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id');
    }

    // Relasi dengan Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
