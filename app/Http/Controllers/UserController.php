<?php

namespace App\Http\Controllers;

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

class UserController extends Controller
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

    public function login(LoginRequest $request)
    {
        $credentials = $request->all();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function me()
    {
        $user = auth()->user();
        return response()->json($user);
    }

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

    public function changeInformation(ChangeInformationRequest $request)
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

    public function find($name)
    {
        $user = User::where('name', '=', $name)->first();

        if(is_null($user)) {
            return response()->json(['error' => 'This user does not exist'], 400);
        }

        return response()->json($user, 200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
