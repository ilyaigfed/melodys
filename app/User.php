<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    private $duration_limit = 7200;

    protected $fillable = [
        'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function followings()
    {
        return $this->hasMany('App\Following', 'follower_id');
    }

    public function followers()
    {
        return $this->hasMany('App\Following', 'owner_id');
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public function playlists()
    {
        return $this->hasMany('App\Playlist');
    }

    public function password_reset()
    {
        return $this->hasOne('App\PasswordReset');
    }

    public function isPro()
    {
        return $this->hasOne('App\Pro')->count() > 0;
    }

    public function availableDuration()
    {
        if($this->isPro()) return -1;

        $sum = $this->tracks()->sum('duration');
        $residue = $this->getDurationLimit() - $sum;

        $residue <= 0 ? $residue = 0: null;

        return $residue;
    }

    public function getDurationLimit()
    {
        return $this->duration_limit;
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

    public function delete()
    {
        $this->followers()->delete();
        $this->followings()->delete();
        $this->tracks()->delete();
        $this->playlists()->delete();
        $this->profile()->delete();

        return parent::delete();
    }
}
