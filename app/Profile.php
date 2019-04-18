<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use SoftDeletes;

    const CREATED_AT = null;

    protected $fillable = [
        'name', 'about', 'image', 'instagram',
        'website', 'twitter', 'link', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function generateLink($str)
    {
        return substr(strtr(strtolower(Hash::make($str)), ['/' => '', '$' => '', '.' => '']), 5, 35);
    }
}
