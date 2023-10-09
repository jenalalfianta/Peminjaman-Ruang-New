<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'status',
        'permission_letter_booking',
        'activity_permission_letter',
        'description',
    ];

    // relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi dengan Ruang
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // relasi dengan transactionRoom
    public function transactionRoom()
    {
        return $this->hasMany(TransactionRoom::class);
    }

    // relasi dengan transactionCancellation
    public function transactionCancellation()
    {
        return $this->hasMany(TransactionCancellation::class);
    }

}
