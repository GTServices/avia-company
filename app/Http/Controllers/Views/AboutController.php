<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Banner;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        $banner = Banner::where('keyword', 'about')->where('status', 1)->orderBy('order')->first();
        return view('view.pages.about', compact('about', 'banner'));
    }
}
