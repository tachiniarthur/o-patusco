<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('userId') ? $this->route('userId') : null;

        return [
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email,' . $userId,
            ],
            'role' => ['required', 'in:admin,user,receptionist,doctor'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
