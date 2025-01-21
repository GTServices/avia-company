<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AirportRequest;
use App\Repositories\CityRepository;
use App\Repositories\LanguageRepository;
use App\Services\Admin\AirportService;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function __construct(private AirportService $airportService, private CityRepository $cityRepository, private LanguageRepository $languageRepository)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['city_id', 'search']);
        $airports = $this->airportService->getFilteredAirports($filters);
        $cities = $this->airportService->getAllCities();
        return view('admin.pages.airports.index', compact('airports', 'filters', 'cities'));
    }


    public function create()
    {
        $languages = $this->languageRepository->all('order', 'asc');
        $cities = $this->airportService->getAllCities();
        return view('admin.pages.airports.create', compact('cities', 'languages'));
    }

    public function store(AirportRequest $request)
    {
        $this->airportService->createAirport($request->validated());

        return redirect()->route('admin.airports.index')
            ->with('success', 'Аэропорт успешно добавлен.');
    }

    public function edit($id)
    {
        $languages = $this->languageRepository->all('order', 'asc');
        $airport = $this->airportService->getAirportById($id);
        $cities = $this->airportService->getAllCities();

        return view('admin.pages.airports.edit', compact('airport', 'cities', 'languages'));
    }

    public function update(AirportRequest $request, $id)
    {
        $this->airportService->updateAirport($id, $request->validated());

        return redirect()->route('admin.airports.index')
            ->with('success', 'Аэропорт успешно обновлён.');
    }

    public function destroy($id)
    {
        $this->airportService->deleteAirport($id);

        return redirect()->route('admin.airports.index')
            ->with('success', 'Аэропорт успешно удалён.');
    }



    //apis
    public function delete_selected(Request $request)
    {
        $ids = $request->input('selected_ids');

        if (!$ids || !is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'Не выбраны города для удаления.']);
        }

        $this->airportService->deleteSelectedCities($ids);

        return response()->json(['success' => true, 'message' => 'Выбранные города успешно удалены.']);
    }
}
