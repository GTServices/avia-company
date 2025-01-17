<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TranslateRequest;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    protected $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function index(Request $request)
    {
        $languages = $this->languageRepository->all();
        $translationsByLanguage = [];
        $filteredTranslations = null;
        $searchQuery = $request->get('search');

        // Hər dil üçün tərcümələri yükləyin
        foreach ($languages as $language) {
            $translationsByLanguage[$language->lang_code] = $this->languageRepository->getTranslations($language->lang_code);
        }

        // Axtarış məntiqi
        if ($searchQuery) {
            $filteredTranslations = [];
            foreach ($translationsByLanguage as $langCode => $translations) {
                foreach ($translations as $key => $value) {
                    if (stripos($key, $searchQuery) !== false || stripos($value, $searchQuery) !== false) {
                        if (!isset($filteredTranslations[$langCode])) {
                            $filteredTranslations[$langCode] = [];
                        }
                        $filteredTranslations[$langCode][$key] = $value;
                    }
                }
            }
        }

        return view('admin.pages.translate.index', compact(
            'languages',
            'translationsByLanguage',
            'filteredTranslations',
            'searchQuery'
        ));
    }


    public function create()
    {
        $languages = $this->languageRepository->all();

        return view('admin.pages.translate.create', compact('languages'));
    }

    public function store(TranslateRequest $request)
    {

        $translations = $request->input('translations');
        $key = $request->input('key');

        foreach ($translations as $langCode => $value) {
            $filePath = resource_path("lang/{$langCode}.json");

            if (file_exists($filePath)) {
                $fileContents = json_decode(file_get_contents($filePath), true);
                $fileContents[$key] = $value;
                file_put_contents($filePath, json_encode($fileContents, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            } else {
                return redirect()->back()->withErrors(['message' => "Language file not found for {$langCode}"]);
            }
        }

        return redirect()->route('admin.translates.index')->with('success', 'Translation added successfully.');
    }


    //apis
    public function updateTranslation(Request $request)
    {
        $request->validate([
            'lang_code' => 'required|string|max:10',
            'key' => 'required|string',
            'value' => 'required|string',
        ]);

        $langCode = $request->input('lang_code');
        $key = $request->input('key');
        $value = $request->input('value');

        // JSON faylını tap və yenilə
        $filePath = resource_path("lang/{$langCode}.json");
        if (file_exists($filePath)) {
            $translations = json_decode(file_get_contents($filePath), true);
            if (isset($translations[$key])) {
                $translations[$key] = $value;
                file_put_contents($filePath, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                return response()->json(['success' => true, 'message' => 'Translation updated successfully.']);
            }
            return response()->json(['success' => false, 'message' => 'Key not found.'], 404);
        }

        return response()->json(['success' => false, 'message' => 'Language file not found.'], 404);
    }



}
