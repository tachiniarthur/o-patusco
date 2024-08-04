<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'symptoms' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'animal_id' => 'required|exists:animals,id',
        ];
    }
}