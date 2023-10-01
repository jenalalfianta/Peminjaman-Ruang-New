<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCancellation extends Model
{
    use HasFactory;

    protected $table = 'booking_cancellations';

    protected $fillable = [
        'booking_id',
        'user_id',
        'reason',
    ];

    // Relasi dengan RoomBooking
    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id');
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
