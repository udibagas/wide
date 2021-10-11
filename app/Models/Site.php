<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'position',
        'modem_sn',
        'public_ip_address',
        'vpn_ip_address',
        'port',
        'username',
        'password'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = encrypt($password);
    }

    public function getPasswordAttribute($password)
    {
        return decrypt($password);
    }
}
