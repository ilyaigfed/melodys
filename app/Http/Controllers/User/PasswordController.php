<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ChangePasswordRequest;
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
    /**
     * @SWG\Post(
     *      path="/api/user/password_recovery",
     *      tags={"User"},
     *      summary="Восстановление пароля",
     *
     *     @SWG\Parameter(
     *         name="email",
     *         description="Адрес электронной почты",
     *         in="query",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Validation error",
     *     ),
     * )
     */

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

        return response(null, 200);
    }

    /**
     * @SWG\Get(
     *     path="/api/user/password_reset",
     *     summary="Сброс пароля",
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="token",
     *         in="query",
     *         description="Токен",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Validation error",
     *     ),
     * )
     */

    public function reset(ResetPasswordRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        $nowTimestamp = now()->timestamp;
        $updatedTimestamp = strtotime($passwordReset->updated_at);

        if($nowTimestamp - $updatedTimestamp > 86400) {
            $passwordReset->delete();
            return response()->json(['error' => 'Истек срок действия токена.'], 400);
        }

        $newPassword = str_random(12);
        $user = $passwordReset->user;
        $user->password = $newPassword;
        $user->save();
        $passwordReset->delete();

        Mail::to($user)->send(new ResetPassword($newPassword));

        return response(null, 200);
    }

    public function change(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->update($request->only(['password']));

        return response(null, 200);
    }
}
