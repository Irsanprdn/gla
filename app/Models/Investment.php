<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    protected $table = 'investments';
    protected $fillable = [
        'name' ,
        'amount' ,
        'investor_id' ,
        'investment_date' ,
        'duration_months' ,
        'rate_of_return' ,
    ];
}
