<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileSaver;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\GetProfileRequest;
use App\Http\Resources\User\ProfileResource;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $data = $request->except(['user_id']);

        $user = auth()->user();
        $profile = $user->profile;

        ProfileResource::withoutWrapping();

        if(!isset($data['image'])) {
            $profile->update($data);

            return new ProfileResource($profile);
        }

        $data['image'] = FileSaver::save((new Profile()), 'image', $request->file('image'), 'avatars');

        $profile->update($data);

        return new ProfileResource($profile);
    }

    public function get(User $user)
    {
        ProfileResource::withoutWrapping();
        return new ProfileResource($user->profile);
    }

    public function me()
    {
        $user = auth()->user();
        ProfileResource::withoutWrapping();
        return new ProfileResource($user->profile);
    }
}
