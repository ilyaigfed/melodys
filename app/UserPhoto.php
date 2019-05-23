<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPhoto extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id', 'image'
    ];
}
