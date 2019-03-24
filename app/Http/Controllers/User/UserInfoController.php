<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ChangeInformationRequest;
use Illuminate\Http\Request;

class UserInfoController extends BaseUserController
{

    public function change(ChangeInformationRequest $request)
    {
        $data = $request->all();

        $user = auth()->user();

        if(!isset($data['image'])) {
            $user->update($data);

            return response()->json(['message' => 'Information successfully changed'], 200);
        }

        $data['image'] = $user->saveProfileImage($request->file('image'));

        $user->update($data);

        return response()->json(['message' => 'Information successfully changed'], 200);
    }
}
