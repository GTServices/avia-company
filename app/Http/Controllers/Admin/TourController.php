<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Repositories\LanguageRepository;
use App\Repositories\TourRepository;
use App\Services\Admin\TourService;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository, private TourRepository $tourRepository, private TourService $tourService)
    {
    }

    public function index()
    {
        $tours = $this->tourRepository->all('datetime','asc');
        return view('admin.pages.tours.index', compact('tours'));
    }

    public function create()
    {
        $languages = $this->languageRepository->all('order');
        return view('admin.pages.tours.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $response = $this->tourService->storeTour($request);

        if (isset($response['errors'])) {
            return redirect()->back()->withErrors($response['errors'])->withInput();
        }

        return redirect()->route('admin.tours.index')->with('success', 'Тур успешно добавлен!');
    }

    public function edit(Tour $tour)
    {
        $languages = $this->languageRepository->all('order');
        return view('admin.pages.tours.edit', compact('tour', 'languages'));
    }

    public function update(Request $request, Tour $tour)
    {
        $response = $this->tourService->updateTour($request, $tour);

        if (isset($response['errors'])) {
            return redirect()->back()->withErrors($response['errors'])->withInput();
        }

        return redirect()->route('admin.tours.index')->with('success', 'Тур успешно обновлен!');
    }

    public function destroy(Request $request, $id = null)
    {
        if ($request->has('selected_ids')) {
            $this->tourService->deleteSelectedTours($request->input('selected_ids'));

            return response()->json([
                'success' => true,
                'message' => 'Выбранные туры успешно удалены.',
            ]);
        }

        $this->tourService->deleteTour($id);

        return redirect()->route('admin.tours.index')->with('success', 'Тур успешно удалён.');
    }

    public function delete_selected(Request $request)
    {
        $ids = $request->input('selected_ids');

        if (!$ids) {
            return response()->json(['success' => false, 'message' => 'Выберите хотя бы один тур.']);
        }

        $this->tourService->deleteSelectedTours($ids);

        return response()->json(['success' => true, 'message' => 'Выбранные туры успешно удалены.']);
    }
}
