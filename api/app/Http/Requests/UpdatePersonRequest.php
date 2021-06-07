<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:64', 'unique:people,name,' . $this->route('person')->id],
            'height' => ['nullable', 'integer'],
            'mass' => ['nullable', 'integer'],
            'hair_color' => ['nullable', 'string', 'max:16'],
            'skin_color' => ['nullable', 'string', 'max:16'],
            'eye_color' => ['nullable', 'string', 'max:16'],
            'gender' => ['nullable', 'string', 'max:16'],
            'planet_id' => ['nullable', 'integer', 'exists:planets,id'],
            'born_at' => ['nullable', 'integer', 'min:-32767', 'max:32767'],
            'died_at' => ['nullable', 'integer', 'min:-32767', 'max:32767'],
        ];
    }
}
