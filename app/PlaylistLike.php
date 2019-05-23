<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaylistLike extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $timestamps = null;
}
