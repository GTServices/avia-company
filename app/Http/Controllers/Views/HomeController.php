<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Repositories\TourRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private TourRepository $tourRepository)
    {

    }
    public function index()
    {
        $tours = $this->tourRepository->all('datetime', 'desc');
        $toursCount = $this->tourRepository->count();
        return view('view.pages.home', compact('tours', 'toursCount'));
    }
}
