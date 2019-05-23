<?php

namespace App\Http\Controllers\User;

use App\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StreamController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $track = Track::whereHas('user', function($q) {
            $q->where('id', '1');
        })->get();

        return $track;
    }
}
