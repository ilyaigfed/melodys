<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @SWG\Definition(
 *  definition="Track",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="title",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="link",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="description",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="image",
 *      type="file"
 *  ),
 *  @SWG\Property(
 *      property="file",
 *      type="file"
 *  ),
 *  @SWG\Property(
 *      property="duration",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="user_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="playlist_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="date-time"
 *  ),
 *  @SWG\Property(
 *      property="updated_at",
 *      type="date-time"
 *  ),
 *  @SWG\Property(
 *      property="deleted_at",
 *      type="date-time"
 *  )
 * )
 */

class Track extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'link', 'description', 'genre_id',
        'image', 'file', 'user_id', 'duration',
        'playlist_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

    public function comments()
    {
        return $this->hasMany('App\TrackComment')->orderBy('created_at', 'desc');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function likes()
    {
        return $this->hasMany('App\TrackLike');
    }

    public function isLiked($track_id, $user_id)
    {
        if(TrackLike::where([
            ['user_id', $user_id],
            ['track_id', $track_id]
        ])->first()) {
            return true;
        }
        return false;
    }

    public function forceDelete()
    {
        Storage::disk('public')->delete($this->image);
        Storage::disk('public')->delete($this->file);

        return parent::forceDelete();
    }
}
