<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ChangeInformationRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Mail\ForgotPassword;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseUserController
{
    public function find($name)
    {
        $user = User::where('name', '=', $name)->first();

        if(is_null($user)) {
            return response()->json(['error' => 'This user does not exist'], 400);
        }

        return response()->json($user, 200);
    }
}
