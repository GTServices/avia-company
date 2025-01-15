<?php
namespace App\Services;

use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterService
{
    public function registerUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        // Əgər istifadəçi mövcuddursa və emaili təsdiqlənməyibsə, sadəcə yenidən təsdiq linki göndər
        if ($user) {
            if (!$user->email_verified_at) {
                if (!$user->verification_token) {
                    // Əgər verification_token boşdursa, yeni token yaradılacaq
                    $user->verification_token = Str::random(64);
                    $user->save();
                }

                // Mövcud istifadəçiyə yenidən email göndər
                Mail::to($user->email)->send(new VerificationEmail($user));

                return [
                    'user' => $user,
                    'message' => 'Your email is already registered but not verified. A new verification link has been sent.',
                ];
            } else {
                return [
                    'user' => $user,
                    'message' => 'This email is already registered and verified. Please login.',
                ];
            }
        }

        // Yeni istifadəçi yarat
        $verificationToken = Str::random(64);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'verification_token' => $verificationToken,
        ]);

        // Email Göndər
        Mail::to($user->email)->send(new VerificationEmail($user));

        return [
            'user' => $user,
            'message' => 'Check your email to verify your account.',
        ];
    }
}
