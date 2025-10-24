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
    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'datetime');
        $sortOrder = $request->get('order', 'asc');
        
        // Handle price sorting
        if ($sortBy === 'price') {
            $sortBy = 'price';
        }
        
        $tours = $this->tourRepository->all($sortBy, $sortOrder, [], 9);
        return view('view.pages.tours.index', compact('tours'));
    }

    public function view($id, $slug)
    {
        $tour = $this->tourRepository->getById($id);
        return view('view.pages.tours.view', compact('tour'));
    }
}
