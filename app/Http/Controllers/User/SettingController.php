<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Setting\UpdateSettingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $setting = $user->setting;

        return $setting;
    }

    public function update(UpdateSettingRequest $request)
    {
        $setting = auth()->user()->setting;

        $setting->update($request->except(['user_id']));

        return $setting;
    }
}
