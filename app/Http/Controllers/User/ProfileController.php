<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ChangeInformationRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{
    public function update(ChangeInformationRequest $request)
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

    public function findOne($user)
    {
        switch (request()->by) {
            case 'link':
                $user = User::where('link', $user)->first();
                break;
            case 'name':
                $user = User::where('name', $user)->first();
                break;
            case 'email':
                $user = User::where('email', $user)->first();
                break;
            default:
                $user = User::find($user);
                break;
        }
        if(!$user) throw new NotFoundHttpException();
        UserResource::withoutWrapping();
        return new UserResource($user);
    }
}
