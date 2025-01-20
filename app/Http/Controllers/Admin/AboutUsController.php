<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository) {}

    /**
     * Show the form for creating about us content.
     */
    public function create()
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.about_us.create', compact('languages'));
    }

    /**
     * Store the about us content in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|array',
            'content.*' => 'nullable|string',
        ]);

        AboutUs::create($data);

        return redirect()->route('admin.about_us.create')->with('success', 'Раздел "О нас" успешно добавлен.');
    }

    /**
     * Show the form for editing the about us content.
     */
    public function edit(AboutUs $aboutUs)
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.about_us.edit', compact('aboutUs', 'languages'));
    }

    /**
     * Update the about us content in storage.
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        $data = $request->validate([
            'content' => 'required|array',
            'content.*' => 'nullable|string',
        ]);

        $aboutUs->update($data);

        return redirect()->route('admin.about_us.create')->with('success', 'Раздел "О нас" успешно обновлен.');
    }
}
