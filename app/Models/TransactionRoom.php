<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRoom extends Model
{
    use HasFactory;

    protected $table = 'booking_rooms';

    protected $fillable = [
        'booking_id',
        'room_id',
    ];

    // relasi dengan Room Booking
    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id');
    }

    // relasi dengan Ruang
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'room_id');
    }

}
