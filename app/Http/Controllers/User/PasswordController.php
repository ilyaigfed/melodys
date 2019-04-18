<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ForgetPasswordRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Mail\ForgetPassword;
use App\Mail\ResetPassword;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function forget(ForgetPasswordRequest $request)
    {
        $token = str_random(64);
        $user = User::where('email', $request->email)->first();

        if(!$user->password_reset) {
            PasswordReset::create([
                'user_id' => $user->id,
                'token'   => $token
            ]);
        } else $user->password_reset->update(['token' => $token]);

        Mail::to($user)->send(new ForgetPassword($token));

        return response()->setStatusCode(200);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        $nowTimestamp = now()->timestamp;
        $createdTimestamp = strtotime($passwordReset->created_at);

        if($nowTimestamp - $createdTimestamp > 86400) {
            $passwordReset->delete();
            return response()->json(['error' => 'The token has expired'], 400);
        }

        $newPassword = str_random(12);
        $user = $passwordReset->user;
        $user->password = $newPassword;
        $user->save();
        $passwordReset->delete();

        Mail::to($user)->send(new ResetPassword($newPassword));

        return response()->setStatusCode(200);
    }
}
