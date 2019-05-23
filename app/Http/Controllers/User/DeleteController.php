<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete()
    {
        $user = auth()->user();
        $user->delete();
        auth()->logout();

        return response(null, 200);
    }
}
