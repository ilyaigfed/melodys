<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Pro",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="user_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="date-time"
 *  )
 * )
 */

class Pro extends Model
{
    protected $fillable = [
        'user_id'
    ];

    const UPDATED_AT = null;
}
