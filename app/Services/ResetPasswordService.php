<?php

namespace App\Services;

use App\Mail\PasswordResetMail;
use App\Models\ResetPasswordCode;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordService
{
    /**
     * Şifrə sıfırlama kodu göndər.
     *
     * @param string $email
     * @return string
     */
    public function sendResetCode(string $email): string
    {
        // İstifadəçini tap
        $user = User::where('email', $email)->first();

        if (!$user) {
            return 'User with this email does not exist.';
        }

        // Yeni kod generasiya et
        $resetCode = Str::random(64); // Daha uzun və unikal kod

        // ResetPasswordCode modelinə əlavə et
        ResetPasswordCode::updateOrCreate(
            ['email' => $email],
            [
                'reset_code' => $resetCode,
                'resetted_at' => null,
            ]
        );

        // Şifrə sıfırlama kodunu göndər
        Mail::to($email)->send(new PasswordResetMail($resetCode, $email));

        return 'Password reset link has been sent to your email.';
    }
}
