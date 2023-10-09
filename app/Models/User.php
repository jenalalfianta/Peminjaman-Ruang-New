<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'isActive',
        'phoneNumber',
        'address',
        'photo',
        'organization',
        'jobTitle',
        'verification_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            $user->email_verified_at = now();
        });
    }

    // relasi dengan transaction
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    // relasi dengan transactionCancellation
    public function transactionCancellation()
    {
        return $this->hasMany(TransactionCancellation::class);
    }
    
}
