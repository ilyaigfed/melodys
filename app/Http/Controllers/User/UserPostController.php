<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserPost\CreateUserPostRequest;
use App\Http\Resources\UserPost\UserPostResource;
use App\Http\Resources\UserPost\UserPostsResource;
use App\User;
use App\UserPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts;

        return new UserPostsResource($posts);
    }

    public function create(User $user, CreateUserPostRequest $request)
    {
        $post = UserPost::create([
            'user_id' => $user->id,
            'text' => $request->text,
            'author_id' => auth()->user()->id
        ]);

        return new UserPostResource($post);
    }
}
