<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Services\Admin\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(private CityService $cityService)
    {

    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $cities = $this->cityService->getAllCities($search);
        return view('admin.pages.cities.index', compact('cities', 'search'));
    }

    public function create()
    {
        $languages = $this->cityService->getLanguages();
        return view('admin.pages.cities.create', compact('languages'));
    }

    public function store(CityRequest $request)
    {
        $this->cityService->createCity($request->validated());

        return redirect()->route('admin.cities.index')
            ->with('success', 'Город успешно добавлен.');
    }

    public function edit($id)
    {
        [$city, $languages] = $this->cityService->getCityForEdit($id);

        return view('admin.pages.cities.edit', compact('city', 'languages'));
    }

    public function update(CityRequest $request, $id)
    {
        $this->cityService->updateCity($id, $request->validated());

        return redirect()->route('admin.cities.index')
            ->with('success', 'Город успешно обновлён.');
    }

    public function destroy($id)
    {
        $this->cityService->deleteCity($id);

        return redirect()->route('admin.cities.index')
            ->with('success', 'Город успешно удалён.');
    }

    //apis
    public function delete_selected(Request $request)
    {
        $ids = $request->input('selected_ids');

        if (!$ids || !is_array($ids)) {
            return response()->json(['success' => false, 'message' => 'Не выбраны города для удаления.']);
        }

        $this->cityService->deleteSelectedCities($ids);

        return response()->json(['success' => true, 'message' => 'Выбранные города успешно удалены.']);
    }
}
