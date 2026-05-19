<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedProfile extends Model
{
    use HasFactory;
    public $table = "like_profiles";

    function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }

    function liker()
    {
        return $this->hasOne(Users::class, 'id', 'my_user_id');
    }
}
