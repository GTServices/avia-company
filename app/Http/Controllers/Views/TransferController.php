<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        return view('view.pages.transfers.index');
    }


    public function view()
    {
        return view('view.pages.transfers.view');
    }
}
