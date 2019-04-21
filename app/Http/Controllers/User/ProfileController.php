<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileSaver;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\User\ProfileResource;
use App\Profile;
use App\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    /**
     * @SWG\Post(
     *      path="/api/user/me/profile",
     *      tags={"User"},
     *      summary="Обновление профиля пользователя",
     *
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Токен",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="_method",
     *         in="formData",
     *         description="Метод запроса put",
     *         required=true,
     *         type="string",
     *         enum={"put"}
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         description="Никнейм",
     *         in="formData",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="link",
     *         description="Ссылка",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="about",
     *         description="О себе",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="image",
     *         description="Аватар",
     *         in="formData",
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         name="instagram",
     *         description="Instagram",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="twitter",
     *         description="Twitter",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="website",
     *         description="Веб-сайт",
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *         examples={
     *           "application/json": {
     *                 "id": 1,
     *                   "name": "babycry",
     *                  "about": null,
     *                   "image": null,
     *                   "instagram": null,
     *                   "website": null,
     *                   "twitter": null,
     *                   "link": "a6mglyeypdjrvaeua3youbxn5n9otlpizxh",
     *                  "user_id": 1
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
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized",
     *     ),
     * )
     */

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->except(['user_id']);

        $user = auth()->user();
        $profile = $user->profile;

        ProfileResource::withoutWrapping();

        if(!isset($data['image'])) {
            $profile->update($data);

            return new ProfileResource($profile);
        }

        $data['image'] = FileSaver::save((new Profile()), 'image', $request->file('image'), 'avatars');

        $profile->update($data);

        return new ProfileResource($profile);
    }

    /**
     * @SWG\Get(
     *     path="/api/user/{user}/profile",
     *     summary="Получение профиля пользователя по ID",
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="user",
     *         in="path",
     *         type="string",
     *         description="ID пользователя",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *         examples={
     *           "application/json": {
     *                 "id": 1,
     *                   "name": "babycry",
     *                  "about": null,
     *                   "image": null,
     *                   "instagram": null,
     *                   "website": null,
     *                   "twitter": null,
     *                   "link": "a6mglyeypdjrvaeua3youbxn5n9otlpizxh",
     *                  "user_id": 1
     *           }
     *         }
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */

    public function get(User $user)
    {
        ProfileResource::withoutWrapping();
        return new ProfileResource($user->profile);
    }

    /**
     * @SWG\Get(
     *     path="/api/user/me/profile",
     *     summary="Получение профиля авторизованного пользователя",
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
     *         examples={
     *           "application/json": {
     *                 "id": 1,
     *                   "name": "babycry",
     *                  "about": null,
     *                   "image": null,
     *                   "instagram": null,
     *                   "website": null,
     *                   "twitter": null,
     *                   "link": "a6mglyeypdjrvaeua3youbxn5n9otlpizxh",
     *                  "user_id": 1
     *           }
     *         }
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function me()
    {
        $user = auth()->user();
        ProfileResource::withoutWrapping();
        return new ProfileResource($user->profile);
    }
}
