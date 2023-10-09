<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'reason',
    ];

    // relasi dengan Room Booking
    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id');
    }

    // relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
