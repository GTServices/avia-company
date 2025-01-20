<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authorized users to access
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'datetime' => 'required|date',
            'count' => 'required|integer|min:1',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id',
            'price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно для заполнения.',
            'title.*.required' => 'Название на всех языках обязательно.',
            'title.*.string' => 'Название должно быть строкой.',
            'title.*.max' => 'Название не должно превышать 255 символов.',
            'description.*.string' => 'Описание должно быть строкой.',
            'image.image' => 'Загруженный файл должен быть изображением.',
            'image.mimes' => 'Изображение должно быть в формате: jpeg, jpg, png, gif.',
            'image.max' => 'Размер изображения не должен превышать 2 МБ.',
            'datetime.required' => 'Дата и время обязательны для заполнения.',
            'datetime.date' => 'Некорректный формат даты и времени.',
            'count.required' => 'Количество пассажиров обязательно.',
            'count.integer' => 'Количество пассажиров должно быть целым числом.',
            'count.min' => 'Количество пассажиров должно быть минимум 1.',
            'departure_airport_id.required' => 'Необходимо выбрать аэропорт вылета.',
            'departure_airport_id.exists' => 'Выбранный аэропорт вылета не существует.',
            'arrival_airport_id.required' => 'Необходимо выбрать аэропорт прилета.',
            'arrival_airport_id.exists' => 'Выбранный аэропорт прилета не существует.',
            'price.required' => 'Цена обязательна для заполнения.',
            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена должна быть не менее 0.',
        ];
    }
}
