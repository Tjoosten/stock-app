<?php

namespace App\Http\Requests\Users\Settings;

use App\Rules\MatchUserPassword;
use Illuminate\Foundation\Http\FormRequest;

class SecurityFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', new MatchUserPassword($this->user())],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
