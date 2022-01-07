<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantsData extends Model
{
    use HasFactory;
    protected $fillable=['merchant_name','maxboost_limit','store_name','password','email','latitude', 'longitude','merchant_maxboost','pannel_password', 'ssh_ip_port','ssh_username','ssh_password','is_own_bitcoin','rpc_username','rpc_password', 'admin_administrator_password','tax_rate', 'notes'];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    
    
   
}
