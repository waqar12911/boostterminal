<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutingNode extends Model
{
    use HasFactory;
    protected $fillable=['ip','port','username','password'];
}
