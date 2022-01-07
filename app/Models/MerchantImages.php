<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantImages extends Model
{
    use HasFactory;
    protected $table = 'merchant_item_image';
    protected $fillable=['merchant_id','upc_number','image'];

    
    
   
}
