<?php

// app/Models/Asset.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'serial_number',
        'value',
        'loan_id'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class); // Relasi banyak ke satu dengan Loan
    }
}
