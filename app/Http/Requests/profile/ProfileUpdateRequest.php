<?php

namespace App\Http\Requests\profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileUpdateRequest extends FormRequest
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
            'name' => 'required',
            'additional_email' => ['nullable', 'email'],
            'additional_mobile' => 'nullable',
            'address' => 'nullable',
            'avater' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }
}
