<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Following extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    const UPDATED_AT = null;
}
