<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\ForgotPasswordRequest;
use App\Mail\ForgotPassword;
use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordController extends BaseUserController
{
    public function forgot(ForgotPasswordRequest $request)
    {
        $token = str_random(64);

        $user = User::where('email', '=', $request->email)->first();

        DB::table('password_resets')->updateOrInsert([
            'email' => $request->email
        ], [
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => now()->toDateTimeString()
        ]);

        Mail::to($user)->send(new ForgotPassword($token));

        return response()->json(['message' => 'Link has been sent to your email'], 200);
    }

    public function reset()
    {
        if(!request()->has('token')) {
            return response()->json(['error' => 'There is no token as parameter'], 400);
        }

        $token = request()->token;

        $stringInDb = DB::table('password_resets')->where('token', '=', $token)->first();

        if(is_null($stringInDb)) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $nowTimestamp = now()->timestamp;
        $createdTimestamp = strtotime($stringInDb->created_at);

        if($nowTimestamp - $createdTimestamp > 86400) {
            DB::table('password_resets')->where('token', '=', $token)->delete();
            return response()->json(['error' => 'The token has expired'], 400);
        }

        $newPassword = str_random(12);

        $user = User::where('email', '=', $stringInDb->email)->first();
        $user->password = $newPassword;
        $user->save();

        DB::table('password_resets')->where('token', '=', $token)->delete();

        Mail::to($user)->send(new ResetPassword($newPassword));

        return response()->json(['message' => 'Password successfully changed'], 200);
    }
}
