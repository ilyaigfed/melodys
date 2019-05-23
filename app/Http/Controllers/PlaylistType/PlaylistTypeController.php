<?php

namespace App\Http\Controllers\PlaylistType;

use App\PlaylistType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaylistTypeController extends Controller
{
    public function index()
    {
        return PlaylistType::all();
    }
}
