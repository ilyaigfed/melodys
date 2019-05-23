<?php

namespace App\Http\Controllers\Track;

use App\Helpers\FileSaver;
use App\Http\Requests\Track\DeleteTrackRequest;
use App\Http\Requests\Track\UpdateTrackRequest;
use App\Http\Requests\Track\UploadTrackRequest;
use App\Http\Resources\Track\TrackResource;
use App\Pro;
use App\Profile;
use App\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use wapmorgan\Mp3Info\Mp3Info;

class TrackController extends Controller
{
    public function get(Track $track)
    {
        TrackResource::withoutWrapping();
        return new TrackResource($track);
    }

    public function upload(UploadTrackRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        if($request->hasFile('image'))
            $data['image'] = FileSaver::save((new Track()), 'image', $request->file('image'), 'track_images');

        $data['file'] = FileSaver::save((new Track()), 'image',  $request->file('file'), 'tracks');
        $data['user_id'] = $user->id;
        $data['duration'] = (int) floor((new Mp3Info(Storage::disk('public')->path($data['file'])))->duration);
        $data['link'] = Profile::generateLink($request->title);

        $track = Track::create($data);

        TrackResource::withoutWrapping();

        return new TrackResource($track);
    }

    public function delete(Track $track, DeleteTrackRequest $request)
    {
        $track->forceDelete();

        return response()->json(['message' => 'Track successfully deleted'], 200);
    }

    public function update(Track $track, UpdateTrackRequest $request)
    {
        $data = $request->except(['file', 'user_id']);
        $user = auth()->user();

        TrackResource::withoutWrapping();

        if(!isset($data['image'])) {
            $track = $track->update($data);

            return new TrackResource($track);
        }

        $data['image'] = $track->saveImage($request->file('image'));

        $track->update($data);

        return new TrackResource($track);
    }
}
