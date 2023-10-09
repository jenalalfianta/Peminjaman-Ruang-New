<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 
        'roomName', 
        'floor', 
        'capacity', 
        'description', 
        'isActive'
    ];

    // relasi dengan transactionRoom
    public function transactionRoom()
    {
        return $this->hasMany(TransactionRoom::class);
    }

}
