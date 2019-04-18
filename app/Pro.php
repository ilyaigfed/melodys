<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro extends Model
{
    protected $fillable = [
        'user_id'
    ];

    const UPDATED_AT = null;
}
