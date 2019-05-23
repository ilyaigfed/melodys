<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    const CREATED_AT = null;

    protected $fillable = [
        'show_profile_photos', 'show_profile_posts',
        'posts_only_from_me', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
