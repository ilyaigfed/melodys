<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;

class UpdateTrackRequest extends BasicRequest
{
    public function authorize()
    {
        $user = auth()->user();
        $track = $this->route('track');

        return $user->can('update', $track);
    }

    public function rules()
    {
        return [
            'title'       => 'string|max:100',
            'link'        => 'string|unique:tracks|max:255',
            'description' => 'string|max:255',
            'image'       => 'image|mimes:jpeg,png|max:5120',
            'playlist_id' => 'exists:playlists,id',
            'genre_id'    => 'exists:genres,id'
        ];
    }

    public function messages()
    {
        return [
            'link.unique'     => 'Ссылка уже используется.',
            'link.string' => 'Поле должно содержать строку.',
            'link.max'       => 'Поле должно содержать максимум 255 символов.',
            'title.string'    => 'Поле должно содержать строку.',
            'title.max'       => 'Поле должно содержать максимум 100 символов.',
            'description.string' => 'Поле должно содержать строку.',
            'description.max'    => 'Поле должно содержать максимум 255 символов.',
            'image.image'     => 'Файл должно быть изображением.',
            'image.mimes'     => 'Файл должен иметь расширение jpeg или png.',
            'image.max'       => 'Файл должен быть максимум 5120 килобайт.',
            'playlist_id'     => 'Плейлиста с таким id не существует.'
        ];
    }

}
