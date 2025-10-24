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
        $search = $request->get('search');
        $dateRange = $request->get('date_range');
        
        // Handle price sorting
        if ($sortBy === 'price') {
            $sortBy = 'price';
        }
        
        // Build filters array
        $filters = [];
        
        // Add search filter
        if ($search) {
            $filters['search'] = $search;
        }
        
        // Add date range filter
        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) === 2) {
                $filters['date_from'] = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]))->format('Y-m-d');
                $filters['date_to'] = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]))->format('Y-m-d');
            }
        }
        
        $tours = $this->tourRepository->all($sortBy, $sortOrder, $filters, 9);
        return view('view.pages.tours.index', compact('tours'));
    }

    public function view($id, $slug)
    {
        $tour = $this->tourRepository->getById($id);
        return view('view.pages.tours.view', compact('tour'));
    }
}
