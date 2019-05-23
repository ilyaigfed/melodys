<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class UpdateProfileRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'name'       => 'max:25',
            'link'       => 'max:35|regex:/^[a-zA-Z0-9_]+$/',
            'about'      => 'max:255',
            'image'      => 'image|mimes:jpeg,png|max:5120',
            'instagram'  => 'nullable|regex:/^[a-zA-Z0-9._]+$/',
            'website'    => 'nullable|url',
            'twitter'    => 'nullable|regex:/^[A-Za-z0-9_]+$/|max:15'
        ];
    }

    public function messages()
    {
        return [
            'name.max'        => 'Поле должно содержать максимум 25 символов.',
            'link.max'        => 'Поле должно содержать максимум 35 символов.',
            'link.regex'      => 'Поле должно содержать только латинские символы, цифры, а также нижнее подчеркивание.',
            'about.max'       => 'Поле должно содержать максимум 255 символов.',
            'image.image'     => 'Файл должнен быть изображением.',
            'image.mimes'     => 'Файл должен иметь расширение jpeg или png.',
            'image.max'       => 'Файл должен быть максимум 5120 килобайт.',
            'instagram.regex' => 'Поле должно содержать только латинские символы, цифры, точку, а также нижнее подчеркивание.',
            'website.url'     => 'Поле должно быть валидным url.',
            'twitter.regex'   => 'Поле должно содержать только латинские символы, цифры, а также нижнее подчеркивание.',
            'twitter.max'     => 'Поле должно содержать максимум 15 символов.'
        ];
    }
}
