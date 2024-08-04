<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'string', 'max:255'],
            'breed' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'numeric', 'min:0'],
            'size' => ['required', 'string', 'max:255'],
        ];
    }
}