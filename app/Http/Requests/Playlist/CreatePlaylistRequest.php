<?php

namespace App\Http\Requests\Playlist;

use App\Http\Requests\BasicRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePlaylistRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'title'        => 'required|string|max:100',
            'description' => 'string|max:255',
            'image'       => 'image|mimes:jpeg,png|max:5120',
            'playlist_type_id' => 'required|exists:playlist_types,id',
            'release_date' => 'date_format:Y-m-d',
            'genre_id'    => 'exists:genres,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required'  => 'Поле обязательно для заполнения.',
            'title.string'    => 'Поле должно содержать строку.',
            'title.max'       => 'Поле должно содержать максимум 100 символов.',
            'image.image'     => 'Файл должно быть изображением.',
            'image.mimes'     => 'Файл должен быть в формате jpeg или png.',
            'image.max'       => 'Файл должен быть максимум 5120 килобайт.',
            'description.string' => 'Поле должно содержать строку.',
            'description.max'    => 'Поле должно содержать максимум 255 символов.',
            'playlist_type_id.exists'   => 'Типа плейлиста с таким id не существует.',
            'playlist_type_id.required' => 'Поле обязательно для заполнения.',
            'release_date.date_format' => 'Дата должна быть в формате d/m/Y',
        ];
    }
}
