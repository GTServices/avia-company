<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true; // İcazə verir.
    }

    public function rules()
    {
        return [
            'lang_code' => 'required|string|max:10',
            'site_lang_code' => 'required|string|max:10',
            'is_main' => 'required|boolean',
            'lang_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'lang_code.required' => 'Поле "Код языка" обязательно для заполнения.',
            'lang_code.string' => 'Поле "Код языка" должно быть строкой.',
            'lang_code.max' => 'Поле "Код языка" не должно превышать 10 символов.',
            'site_lang_code.required' => 'Поле "Код языка сайта" обязательно для заполнения.',
            'site_lang_code.string' => 'Поле "Код языка сайта" должно быть строкой.',
            'site_lang_code.max' => 'Поле "Код языка сайта" не должно превышать 10 символов.',
            'is_main.required' => 'Поле "Основной язык" обязательно для заполнения.',
            'is_main.boolean' => 'Поле "Основной язык" должно быть логическим значением.',
            'lang_name.required' => 'Поле "Название языка" обязательно для заполнения.',
            'lang_name.string' => 'Поле "Название языка" должно быть строкой.',
            'lang_name.max' => 'Поле "Название языка" не должно превышать 255 символов.',
        ];
    }
}
