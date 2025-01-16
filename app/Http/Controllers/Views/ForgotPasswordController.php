<?php
namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Http\Requests\View\Passwords\ResetPasswordRequest;
use App\Services\ResetPasswordService;

class ForgotPasswordController extends Controller
{
    protected $resetPasswordService;

    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }

    /**
     * Şifrə sıfırlama formunu göstər.
     */
    public function index()
    {
        return view('view.pages.auth.passwords.forgot');
    }

    /**
     * Şifrə sıfırlama kodu göndər.
     */
    public function sendResetLinkEmail(ResetPasswordRequest $request)
    {
        $message = $this->resetPasswordService->sendResetCode($request->email);

        return redirect()->back()->with('success', $message);
    }
}
