<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Playlist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'link', 'description',
        'image', 'user_id', 'release_date', 'playlist_type_id'
    ];
}
