<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Verify Your Email')
            ->view('view.mail_templates._verify')
            ->with([
                'verificationUrl' => route('view.auth.verify.email', ['token' => $this->user->verification_token]),
            ]);
    }
}
