<?php

namespace App\Http\Requests\Auth\ChangePassword;

use App\Rules\Verify\VerifyOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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

        $user = auth()->user();

        return [
            'old_password' => ['required', new VerifyOldPassword($user)],
            'password' => ['required','between:8,32','confirmed'],
        ];
    }
}
