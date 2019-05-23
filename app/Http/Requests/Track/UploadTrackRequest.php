<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;
use App\Rules\AvailableFileDuration;
use Illuminate\Support\Facades\Validator;

class UploadTrackRequest extends BasicRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|max:100',
            'description' => 'string|max:255',
            'image'       => 'image|mimes:jpeg,png|max:5120',
            'file'        => ['bail', 'required', 'file', 'mimes:mpga', new AvailableFileDuration],
            'playlist_id' => 'exists:playlists,id',
            'genre_id'    => 'exists:genres,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required'  => 'Поле обязательно для заполнения.',
            'title.string'    => 'Поле должно содержать строку.',
            'title.max'       => 'Поле должно содержать максимум 100 символов.',
            'description.string' => 'Поле должно содержать строку.',
            'description.max'    => 'Поле должно содержать максимум 255 символов.',
            'image.image'     => 'Файл должно быть изображением.',
            'image.mimes'     => 'Файл должен быть в формате jpeg или png.',
            'image.max'       => 'Файл должен быть максимум 5120 килобайт.',
            'playlist_id'     => 'Плейлиста с таким id не существует.',
            'file.required'   => 'Поле обязательно для заполнения.',
            'file.file'       => 'Поле должно содержать файл.',
            'file.mimes'      => 'Файл должен быть в формате mp3.',
        ];
    }
}
