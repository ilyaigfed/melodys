<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function resetPassword()
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
