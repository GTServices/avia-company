<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\UserRule;
use Illuminate\Http\Request;

class TermsOfUseController extends Controller
{
    public function index()
    {
        $terms_of_use = UserRule::first();
        return view('view.pages.terms_of_use', compact('terms_of_use'));
    }
}
