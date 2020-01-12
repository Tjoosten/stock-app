<?php

namespace App\Http\Requests\Users\Settings;

use Illuminate\Foundation\Http\FormRequest;

class InformationFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user()->id],
        ];
    }
}
