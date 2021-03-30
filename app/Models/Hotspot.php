<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RouterOS\Client;
use RouterOS\Query;

class Hotspot extends Model
{
    use HasFactory;

    public function router()
    {
        return $this->belongsTo(Router::class);
    }

    public static function addUser($user)
    {
    }

    public static function addUserProfile($user)
    {
    }

    public static function getUser($params)
    {
        $response = (new Query('/ip/hotspot/user/print'));
    }

    public static function getUserProfile($params)
    {
    }

    public static function countUser($params)
    {
    }

    public static function countUserProfile($params)
    {
    }
}
