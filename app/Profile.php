<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * @SWG\Definition(
 *  definition="Profile",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="about",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="image",
 *      type="file"
 *  ),
 *  @SWG\Property(
 *      property="instagram",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="website",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="twitter",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="link",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="user_id",
 *      type="integer"
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

class Profile extends Model
{
    use SoftDeletes;

    const CREATED_AT = null;

    protected $fillable = [
        'name', 'about', 'image', 'instagram',
        'website', 'twitter', 'link', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function generateLink($str)
    {
        return substr(strtr(strtolower(Hash::make($str)), ['/' => '', '$' => '', '.' => '']), 5, 35);
    }
}
