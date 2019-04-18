<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\Track\TracksResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    public function getSeveral(User $user)
    {
        return new TracksResource($user->tracks()->paginate(10));
    }
}
