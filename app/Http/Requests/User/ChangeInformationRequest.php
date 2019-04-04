<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangeInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ])->setStatusCode(400, 'Validation error'));
    }
}
