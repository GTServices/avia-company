<?php

namespace App\Http\Controllers\Views\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\View\RegisterRequest;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index()
    {
        return view('view.pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->registerService->registerUser($request->validated());

        if ($result['message'] === 'Your email is already registered but not verified. A new verification link has been sent.') {
            return back()->with('warning', $result['message']);
        }

        if ($result['message'] === 'This email is already registered and verified. Please login.') {
            return back()->with('warning', $result['message']);
        }

        return back()->with('success', $result['message']);
    }
}
