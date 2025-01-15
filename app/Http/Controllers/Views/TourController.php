<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        return view('view.pages.tours.index');
    }

    public function view()
    {
        return view('view.pages.tours.view');
    }
}
