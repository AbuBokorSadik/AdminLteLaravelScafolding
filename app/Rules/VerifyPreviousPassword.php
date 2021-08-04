<?php

namespace App\Rules;

use App\Traits\PA_DSS_Auth_Trait;
use Illuminate\Contracts\Validation\Rule;

class VerifyPreviousPassword implements Rule
{
    use PA_DSS_Auth_Trait;

    private $user;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        return ! $this->isPasswordMatchesWithXPreviousPassword($this->user,$value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry! the password you are tyring to set matches with one of the 5 previous passwords. Please try a different one.';
    }
}
