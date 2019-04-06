<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\GetProfileRequest;
use App\Http\Resources\User\ProfileResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $data = $request->except(['password', 'email']);

        $user = auth()->user();

        if(!isset($data['image'])) {
            $user->update($data);

            return response()->json(['message' => 'Information successfully changed'], 200);
        }

        $data['image'] = $user->saveProfileImage($request->file('image'));

        $user->update($data);

        return response()->json(['message' => 'Information successfully changed'], 200);
    }

    public function get(GetProfileRequest $request)
    {
        switch ($request->by) {
            case 'link':
                $user = User::where('link', $request->user)->first();
                break;
            case 'name':
                $user = User::where('name', $request->user)->first();
                break;
            case 'email':
                $user = User::where('email', $request->user)->first();
                break;
            default:
                $user = User::find($request->user);
                break;
        }
        if(!$user) throw new NotFoundHttpException();
        ProfileResource::withoutWrapping();
        return new ProfileResource($user);
    }
}
