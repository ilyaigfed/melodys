<?php

namespace App\Http\Controllers\Track;

use App\Http\Resources\TrackComment\TrackCommentResource;
use App\Http\Resources\TrackComment\TrackCommentsResource;
use App\Track;
use App\TrackComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackCommentController extends Controller
{
    public function index(Track $track)
    {
        return new TrackCommentsResource($track->comments);
    }

    public function create(Track $track, Request $request)
    {
        $user = auth()->user();

        $comment = TrackComment::create([
            'text' => $request->text,
            'user_id' => $user->id,
            'track_id' => $track->id
        ]);

        TrackCommentResource::withoutWrapping();

        return new TrackCommentResource($comment);
    }
}
