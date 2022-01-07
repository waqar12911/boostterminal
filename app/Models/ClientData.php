<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    use HasFactory;
    protected $fillable=['client_name',
                         'client_id',
                         'national_id',
                         'address',
                         'email',
                         'dob',
                         'is_gamma_user',
                         'registered_at',
                         'is_active',
                         'client_image_id',
                         'card_image_id',
                         'client_backend_password',
                         'client_maxboost',
                         'merchant_id',
                         'maxboost_limit',
						 'client_type',
                         'user_id',
                        ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
