<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=['transaction_label','transaction_id','transaction_amountBTC','transaction_amountUSD','transaction_clientId',
    'transaction_merchantId','transaction_timestamp','merchant_remaining','client_remaining','conversion_rate'];
    
    
}
