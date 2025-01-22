<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('view.pages.about', compact('about'));
    }
}
