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
        // 'duration_months' ,
        // 'rate_of_return' ,
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }

    public function getInvestorsWithNames()
    {
        return self::leftJoin('investors as b', 'investments.investor_id', '=', 'b.id')
            ->select('investments.*', 'b.name as name_investor')
            ->get();
    }
}
