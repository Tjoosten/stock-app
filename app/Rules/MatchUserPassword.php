<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchUserPassword implements Rule
{
    protected User $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string   $attribute The name from the attribute field.
     * @param  mixed    $value     The value from the arrtibute.
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, $this->user->getAuthPassword());
    }
    
    public function message(): string
    {
        return __('validation.matchUserPassword');
    }
}
