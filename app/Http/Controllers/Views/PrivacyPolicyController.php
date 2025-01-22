<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacy_policy = PrivacyPolicy::first();
        return view('view.pages.privacy_policy', compact('privacy_policy'));
    }
}
