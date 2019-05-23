<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'text', 'author_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
