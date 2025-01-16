<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetCode;
    public $email;

    /**
     * Yeni mailable sinfi yaradın.
     *
     * @param string $resetCode
     * @param string $email
     */
    public function __construct(string $resetCode, string $email)
    {
        $this->resetCode = $resetCode;
        $this->email = $email;
    }

    /**
     * Mesajı qur və göndər.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset Link')
            ->view('view.mail_templates.password_reset_email')
            ->with([
                'resetLink' => route('view.auth.password.reset', [
                    'email' => $this->email,
                    'code' => $this->resetCode,
                ]),
            ]);
    }
}
