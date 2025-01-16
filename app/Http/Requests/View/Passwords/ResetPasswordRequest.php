<?php

namespace App\Http\Requests\View\Passwords;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * İcazə vermə metodudur.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Doğrulama qaydalarını təyin edir.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            '_token' => 'required',
        ];
    }

    /**
     * Xətalar üçün xüsusi mesajlar.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.exists' => 'This email does not exist in our records.',

            '_token.required' => 'The reset token is required.',
        ];
    }
}
