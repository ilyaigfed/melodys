<?php

namespace App\Policies;

use App\User;
use App\UserPhoto;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPhotoPolicy
{
    use HandlesAuthorization;

    public function forceDelete(User $user, UserPhoto $photo)
    {
        return $user->id === $photo->user_id;
    }
}
