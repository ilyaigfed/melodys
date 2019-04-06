<?php

namespace App\Http\Controllers\User;

use App\Following;
use App\Http\Requests\User\FollowRequest;
use App\Http\Requests\User\GetFollowingsRequest;
use App\Http\Requests\User\UnfollowRequest;
use App\Http\Resources\User\FollowingsResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowingController extends Controller
{
    public function getSeveral(GetFollowingsRequest $request)
    {
        $user = User::find($request->id);
        return new FollowingsResource($user->followings()->paginate(20));
    }

    public function unfollow(UnfollowRequest $request)
    {
        $me = auth()->user();

        Following::where('owner_id', '=', $request->id)->where('follower_id', '=', $me->id)->delete();

        return response()->json(['message' => 'You have successfully unfollowed'], 200);
    }

    public function follow(FollowRequest $request)
    {
        $me = auth()->user();

        Following::create([
            'owner_id'    => $request->id,
            'follower_id' => $me->id
        ]);

        return response()->json(['message' => 'You have successfully become a follower'], 200);
    }

}
