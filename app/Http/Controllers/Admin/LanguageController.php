<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use App\Repositories\LanguageRepository;
use App\Services\Admin\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository, private LanguageService $languageService)
    {
    }

    public function index()
    {
        $languages = $this->languageRepository->all("order", "asc", []);
        return view('admin.pages.translate.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.pages.translate.create');
    }

    public function store(LanguageRequest $request)
    {
        $this->languageService($request);
        return redirect()->route('admin.languages.index')->with('success', 'Язык успешно добавлен!');
    }

    public function destroy(Request $request, $id = null)
    {
        if ($id) {
            // Delete single language
            Language::findOrFail($id)->delete();
        } elseif ($request->has('selected_ids')) {
            // Bulk delete
            Language::whereIn('id', $request->selected_ids)->delete();
        }

        return redirect()->route('admin.languages.index')->with('success', 'Выбранные языки успешно удалены!');
    }
}
