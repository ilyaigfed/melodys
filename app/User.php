<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'about', 'image',
        'instagram', 'website', 'twitter', 'link'
    ];

    protected $hidden = [
        'password'
    ];

    public function followings()
    {
        return $this->hasMany('App\Following', 'follower_id');
    }

    public function followers()
    {
        return $this->hasMany('App\Following', 'owner_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        if(!empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function saveProfileImage($image)
    {
        if(!is_null($this->image)) {
            Storage::disk('public')->delete($this->image);
        }

        $name = strtolower(str_random(16));

        $firsrtLetter = substr($name, 0, 1);

        $folder = 'avatars/'.$firsrtLetter;

        $filename = $name.'.'.$image->clientExtension();

        $image->storeAs($folder, $filename, 'public');

        return $folder.'/'.$filename;
    }

    public static function generateLink($str)
    {
        return substr(strtr(strtolower(Hash::make($str)), ['/' => '', '$' => '', '.' => '']), 5, 35);
    }
}
