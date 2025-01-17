<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TranslateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Иcразрешено.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string',
            'translations' => 'required|array',
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'key.required' => 'Поле "Ключ перевода" обязательно для заполнения.',
            'key.string' => 'Поле "Ключ перевода" должно быть строкой.',
            'translations.required' => 'Поле "Переводы" обязательно для заполнения.',
            'translations.array' => 'Поле "Переводы" должно быть массивом.',
        ];
    }
}
