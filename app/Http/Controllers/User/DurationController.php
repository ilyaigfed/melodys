<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DurationController extends Controller
{
    public function get()
    {
        $user = auth()->user();

        return response()->json(['duration' => $user->availableDuration()], 200);
    }
}
