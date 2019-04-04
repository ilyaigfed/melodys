<?php

namespace App\Http\Controllers\User;

use App\Following;
use App\Http\Resources\FollowersResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    public function find(User $user)
    {
        return new FollowersResource($user->followers()->paginate(20));
    }

    public function unfollow(User $user)
    {
        $me = auth()->user();

        Following::where('owner_id', '=', $user->id)->where('follower_id', '=', $me->id)->delete();

        return response()->json(['message' => 'You have successfully unfollowed'], 200);
    }

    public function follow(User $user)
    {
        $me = auth()->user();

        Following::create([
            'owner_id'    => $user->id,
            'follower_id' => $me->id
        ]);

        return response()->json(['message' => 'You have successfully become a '.$user->name.'\'s follower'], 200);
    }
}
