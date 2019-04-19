<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *  definition="Following",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="owner_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="follower_id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="created_at",
 *      type="date-time"
 *  ),
 *  @SWG\Property(
 *      property="deleted_at",
 *      type="date-time"
 *  )
 * )
 */

class Following extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    const UPDATED_AT = null;
}
