<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\User\ForgotPasswordRequest;
use App\Mail\ForgotPassword;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request)
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
}
