<?php

namespace App\Http\Requests\Auth\ChangePassword;

use App\Rules\Verify\VerifyOldPassword;
use App\Rules\VerifyPreviousPassword;
use App\Traits\PA_DSS_Auth_Trait;
use Illuminate\Foundation\Http\FormRequest;


class ChangePasswordRequest extends FormRequest
{
    use PA_DSS_Auth_Trait;
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
            'password' => [
                'required',
                'between:8,32',
                'confirmed',
                'regex:' . $this->passwordRegexPattern,
                new VerifyPreviousPassword($user),
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character (e.g. $ % & _ + - . @ #)',
        ];
    }
}