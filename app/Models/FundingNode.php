<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingNode extends Model
{
    use HasFactory;
    
    protected $fillable=['ip','port','username','password','merchant_boost_fee','lightning_boost_fee','node_id','registration_fees'];
}
