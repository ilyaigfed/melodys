<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="PasswordReset",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="user_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="token",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="date-time"
 *  ),
 *  @SWG\Property(
 *      property="updated_at",
 *      type="date-time"
 *  )
 * )
 */

class PasswordReset extends Model
{
    protected $fillable = [
        'user_id', 'token'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
