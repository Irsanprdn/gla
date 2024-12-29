<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank'; // Nama tabel
    protected $primaryKey = 'id_bank'; // Primary key
    public $timestamps = true; // Aktifkan timestamps

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'nama_bank',
        'kode_bank',
        'created_at',
        'updated_at',
    ];
}
