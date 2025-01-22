<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Repositories\TourRepository;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function __construct(private TourRepository $tourRepository)
    {

    }
    public function index()
    {
        $tours = $this->tourRepository->all('datetime', 'asc', [], 9);
        return view('view.pages.tours.index', compact('tours'));
    }

    public function view($id, $slug)
    {
        $tour = $this->tourRepository->getById($id);
        return view('view.pages.tours.view', compact('id'));
    }
}
