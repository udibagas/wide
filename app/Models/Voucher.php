<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'dns',
        'profile',
        'uptime',
        'validity',
        'price',
        'seller_price',
        'code',
        'comment',
    ];
}
