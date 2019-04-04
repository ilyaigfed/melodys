<?php

namespace App\Http\Controllers\User;

use App\Following;
use App\Http\Resources\FollowingsResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FollowingController extends Controller
{
    public function find(User $user)
    {
        return new FollowingsResource($user->followings()->paginate(20));
    }
}
