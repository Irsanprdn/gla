<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dari default (jika perlu)
    protected $table = 'incomes';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'income_name', // income_name menggantikan nama_pemasukan
        'amount',      // amount menggantikan jumlah
        'date',        // date menggantikan tanggal
        'description', // description menggantikan deskripsi
        'bank_id',     // bank_id
    ];

    // Tentukan kolom yang harus di-cast (misalnya ke tipe date atau decimal)
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2', // Menentukan jumlah sebagai decimal dengan 2 desimal
    ];

    // Relasi dengan model Bank, jika ada
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'id');
    }

    // Jika perlu, tambahkan relasi lainnya
}
