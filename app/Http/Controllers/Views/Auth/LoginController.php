<?php
namespace App\Http\Controllers\Views\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\View\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        return view('view.pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $result = $this->loginService->loginUser($request->validated());

        if ($result['type'] === 'warning') {
            return redirect()->route('view.auth.login')->with('warning', $result['message']);
        }

        if ($result['type'] === 'error') {
            return redirect()->route('view.auth.login')->with('error', $result['message']);
        }

        return redirect()->route('view.home')->with('success', $result['message']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('view.auth.login');
    }
}
