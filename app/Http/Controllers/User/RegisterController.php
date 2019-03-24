<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\RegisterRequest;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends BaseUserController
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }
}
