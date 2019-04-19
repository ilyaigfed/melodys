<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use wapmorgan\Mp3Info\Mp3Info;

class AvailableFileDuration implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = auth()->user();

        if($user->isPro()) return true;

        $duration = (int) floor((new Mp3Info($value))->duration);

        if($user->availableDuration() + $duration > $user->getDurationLimit()) {
            return false;
        } else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Длительность аудиофайла не позволяет загрузить его.';
    }
}
