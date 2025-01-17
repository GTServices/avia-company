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
        return view('admin.pages.language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.pages.language.create');
    }

    public function store(LanguageRequest $request)
    {

        $this->languageService->add($request);
        return redirect()->route('admin.languages.index')->with('success', 'Язык успешно добавлен!');
    }

    public function edit($id)
    {
        $language = $this->languageRepository->getById($id);
        return view('admin.pages.language.edit', compact('language'));
    }

    public function update(LanguageRequest $request, $id)
    {
        $language = $this->languageRepository->getById($id);
        $this->languageService->update($language, $request);

        return redirect()->route('admin.languages.index')->with('success', 'Язык успешно обновлен!');
    }


    public function destroy(Request $request, $id = null)
    {
        if ($id) {
            // Single delete
            $this->languageService->destroy($id);
        } elseif ($request->has('selected_ids')) {
            // Bulk delete
            $this->languageService->bulkDestroy($request->input('selected_ids'));
        }

        return redirect()->route('admin.languages.index')->with('success', 'Выбранные языки успешно удалены!');
    }

























    // apis

    public function delete_languages(Request $request)
    {
        $selectedIds = $request->input('selected_ids', []);

        if (!empty($selectedIds)) {
            $this->languageService->bulkDestroy($selectedIds);

            return response()->json(['success' => true, 'message' => 'Выбранные языки успешно удалены!']);
        }

        return response()->json(['success' => false, 'message' => 'Нет выбранных языков.']);
    }


    public function reorder(Request $request)
    {
        $order = $request->input('order', []);

        if (!empty($order)) {
            foreach ($order as $index => $id) {
                Language::where('id', $id)->update(['order' => $index + 1]);
            }

            return response()->json(['success' => true, 'message' => 'Порядок языков успешно обновлен!']);
        }

        return response()->json(['success' => false, 'message' => 'Некорректные данные.']);
    }
}
