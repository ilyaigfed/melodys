<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileSaver;
use App\Http\Requests\User\DeleteUserPhotoRequest;
use App\Http\Requests\User\UploadUserPhotoRequest;
use App\Http\Resources\UserPhoto\UserPhotoResource;
use App\Http\Resources\UserPhoto\UserPhotosResource;
use App\User;
use App\UserPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPhotoController extends Controller
{
    public function upload(UploadUserPhotoRequest $request)
    {
        $user = auth()->user();
        $data = $request->only(['image']);
        $data['image'] = FileSaver::save((new UserPhoto()), 'image', $request->file('image'), 'user_photos');
        $data['user_id'] = $user->id;

        $photo = UserPhoto::create($data);

        return new UserPhotoResource($photo);
    }

    public function index(User $user)
    {
        return new UserPhotosResource($user->photos);
    }

    public function destroy(UserPhoto $photo, DeleteUserPhotoRequest $request)
    {
        $photo->forceDelete();

        return response(null, 200);
    }
}
