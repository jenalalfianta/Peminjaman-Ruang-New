<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = 'ruang';
    protected $fillable = ['kode_ruangan', 'nama_ruangan', 'lantai_ruangan', 'kapasitas', 'deskripsi', 'aktif'];
}
