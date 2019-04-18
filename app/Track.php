<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Track extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'link', 'description',
        'image', 'file', 'user_id', 'duration'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

    public function forceDelete()
    {
        Storage::disk('public')->delete($this->image);
        Storage::disk('public')->delete($this->file);

        return parent::forceDelete();
    }
}
