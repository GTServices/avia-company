<?php

namespace App\Services;

use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginService
{
    public function loginUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        // Əgər istifadəçi tapılmadısa
        if (!$user) {
            return [
                'status' => false,
                'message' => 'Invalid email or password.',
                'type' => 'error'
            ];
        }

        // Əgər email təsdiqlənməyibsə
        if (!$user->email_verified_at) {
            if (!$user->verification_token) {
                $user->verification_token = Str::random(64);
                $user->save();
            }

            // Yenidən təsdiq emaili göndər
            Mail::to($user->email)->send(new VerificationEmail($user));

            return [
                'status' => false,
                'message' => 'Your email is not verified. A new verification link has been sent.',
                'type' => 'warning'
            ];
        }

        // Əgər şifrə səhvdirsə
        if (!Hash::check($data['password'], $user->password)) {
            return [
                'status' => false,
                'message' => 'Invalid email or password.',
                'type' => 'error'
            ];
        }

        // Login uğurludur
        Auth::login($user);

        return [
            'status' => true,
            'message' => 'Successfully logged in.',
            'type' => 'success'
        ];
    }
}
