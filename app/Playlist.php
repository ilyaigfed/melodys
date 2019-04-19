<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @SWG\Definition(
 *  definition="Playlist",
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
 *      property="user_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="playlist_type_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="release_date",
 *      type="date"
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

class Playlist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'link', 'description',
        'image', 'user_id', 'release_date', 'playlist_type_id'
    ];
}
