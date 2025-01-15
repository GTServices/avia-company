<?php
namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('view.auth.login')->with('error', 'Invalid verification token.');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        return redirect()->route('view.auth.login')->with('success', 'Your email has been verified! You can now login.');
    }
}
