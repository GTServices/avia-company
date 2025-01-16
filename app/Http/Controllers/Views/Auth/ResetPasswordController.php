<?php

namespace App\Http\Controllers\Views\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\View\Passwords\ResetPostPasswordRequest;
use App\Http\Requests\View\Passwords\SetNewPasswordRequest;
use App\Models\ResetPasswordCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index($email, $code)
    {


        // Email və kodu yoxla
        $resetCode = ResetPasswordCode::where('email', $email)
            ->where('reset_code', $code)
            ->first();

        if (!$resetCode) {
            return redirect()->route('view.auth.password.forgot')
                ->with('error', 'Invalid or expired reset link.');
        }

        // Email və kodu görünüşə ötür
        return view('view.pages.auth.passwords.reset', compact('email', 'code'));
    }

    public function reset(SetNewPasswordRequest $request)
    {
        // Email və kodu yoxla
        $resetCode = ResetPasswordCode::where('email', $request->email)
            ->where('reset_code', $request->code)
            ->first();

        if (!$resetCode) {
            return redirect()->route('view.auth.password.reset', [
                'email' => $request->email,
                'code' => $request->code,
            ])->with('error', 'Invalid or expired reset code.');
        }

        // İstifadəçini tap və şifrəni yenilə
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('view.auth.password.reset', [
                'email' => $request->email,
                'code' => $request->code,
            ])->with('error', 'User not found.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Kodun istifadəsini tamamla
        $resetCode->delete();

        return redirect()->route('view.auth.login')->with('success', 'Your password has been successfully reset. You can now login.');
    }


}
