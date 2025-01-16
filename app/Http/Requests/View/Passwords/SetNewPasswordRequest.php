<?php

namespace App\Http\Requests\View\Passwords;

use Illuminate\Foundation\Http\FormRequest;

class SetNewPasswordRequest extends FormRequest
{
    /**
     * İcazə verilib-verilmədiyini yoxla.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validasiya qaydalarını təyin et.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'code' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ];
    }

    /**
     * Xüsusi xəta mesajları.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'code.required' => 'Reset code is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Passwords do not match.',
        ];
    }
}
