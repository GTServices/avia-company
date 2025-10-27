<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $banner = Banner::where('keyword', 'contact')->where('status', 1)->orderBy('order')->first();
        return view('view.pages.contact', compact('banner'));
    }
}
