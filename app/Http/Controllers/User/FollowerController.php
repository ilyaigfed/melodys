<?php

namespace App\Http\Controllers\User;

use App\Following;
use App\Http\Requests\User\GetFollowersRequest;
use App\Http\Resources\User\FollowersResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    public function getSeveral(User $user)
    {
        return new FollowersResource($user->followers);
    }
}
