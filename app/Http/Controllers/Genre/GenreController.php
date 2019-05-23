<?php

namespace App\Http\Controllers\Genre;

use App\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function index()
    {
        return Genre::all();
    }
}
