<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtcPrice extends Model
{
    use HasFactory;

    public $table = 'btc_prices';

    protected $fillable = [
        'crypto',
        'currency',
        'priceDay',
        'volumeDay',
        'lastTradePrice'
    ];
}

