<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // İstifadəçinin bu istəyi göndərməyə icazəsi var
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|array', // Name sahəsi array formatında olmalıdır
            'name.*' => 'required|string', // Hər bir dil üçün name dəyəri tələb olunur və string olmalıdır
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Название города обязательно.',
            'name.*.required' => 'Название города для каждого языка обязательно.',
            'name.*.string' => 'Название города должно быть строкой.',
        ];
    }
}
