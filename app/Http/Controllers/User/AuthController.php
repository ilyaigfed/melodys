<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\ProfileResource;
use App\Profile;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @SWG\Post(
     *      path="/api/user/registration",
     *      tags={"User"},
     *      summary="Регистрация пользователя",
     *
     *     @SWG\Parameter(
     *         name="email",
     *         description="Адрес электронной почты",
     *         in="query",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         description="Никнейм",
     *         in="query",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         description="Пароль",
     *         in="query",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="r_password",
     *         description="Повтор пароля",
     *         in="query",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="terms",
     *         description="Согласие с правилами проекта",
     *         in="query",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *         examples={
     *           "application/json": {
     *             "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTU1NTYzMzgxMiwiZXhwIjoxNTU1NjM3NDEyLCJuYmYiOjE1NTU2MzM4MTIsImp0aSI6Ink0VGtxWG05TE40YWRQYnciLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.isl9JCJ7vUuakqRHMWvwlYtpZfSvj7KVNvm4uTj_GcY",
     *             "token_type": "bearer",
     *             "expires_in": 3600
     *           }
     *         }
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Validation error",
     *         examples={
     *           "application/json": {
     *                   "errors": {
     *                       "field": {
     *                           "Поле обязательно для заполнения."
     *                       }
     *                   }
     *           }
     *         }
     *     ),
     * )
     */

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $profile = Profile::create([
            'name'     => $request->name,
            'link'     => Profile::generateLink($request->name),
            'user_id'  => $user->id
        ]);

        $setting = Setting::create([
            'user_id' => $user->id
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * @SWG\Post(
     *      path="/api/user/login",
     *      tags={"User"},
     *      summary="Авторизация пользователя",
     *
     *     @SWG\Parameter(
     *         name="email",
     *         description="Адрес электронной почты",
     *         in="query",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         description="Пароль",
     *         in="query",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *         examples={
     *           "application/json": {
     *             "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTU1NTYzMzgxMiwiZXhwIjoxNTU1NjM3NDEyLCJuYmYiOjE1NTU2MzM4MTIsImp0aSI6Ink0VGtxWG05TE40YWRQYnciLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.isl9JCJ7vUuakqRHMWvwlYtpZfSvj7KVNvm4uTj_GcY",
     *             "token_type": "bearer",
     *             "expires_in": 3600
     *           }
     *         }
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Validation error",
     *         examples={
     *           "application/json": {
     *                   "errors": {
     *                       "field": {
     *                           "Поле обязательно для заполнения."
     *                       }
     *                   }
     *           }
     *         }
     *     ),
     * )
     */

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials))
            return response(null, 401);

        return $this->respondWithToken($token);
    }

    /**
     * @SWG\Get(
     *     path="/api/user/logout",
     *     summary="Разавторизация пользователя",
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Токен",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function logout()
    {
        auth()->logout();

        return response(null, 200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'user' => $this->guard()->user()->profile
        ], 200);
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function refresh()
    {
        $token = JWTAuth::getToken();
        if(!$token) {
            throw new BadRequestHttpException('Token not provided');
        }

        try {
            $token = JWTAuth::refresh($token);
        } catch(TokenExpiredException $e) {
            return response(null, 406);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ], 200);
    }
}
