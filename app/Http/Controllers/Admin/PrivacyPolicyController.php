<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository) {}

    /**
     * Show the form for creating a new privacy policy.
     */
    public function create()
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.privacy_policies.create', compact('languages'));
    }

    /**
     * Store a newly created privacy policy in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'policy' => 'required|array',
            'policy.*' => 'nullable|string',
        ]);

        PrivacyPolicy::create($data);

        return redirect()->route('admin.privacy_policies.create')->with('success', 'Политика конфиденциальности успешно добавлена.');
    }

    /**
     * Show the form for editing the specified privacy policy.
     */
    public function edit(PrivacyPolicy $privacyPolicy)
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.privacy_policies.edit', compact('privacyPolicy', 'languages'));
    }

    /**
     * Update the specified privacy policy in storage.
     */
    public function update(Request $request, PrivacyPolicy $privacyPolicy)
    {
        $data = $request->validate([
            'policy' => 'required|array',
            'policy.*' => 'nullable|string',
        ]);

        $privacyPolicy->update($data);

        return redirect()->route('admin.privacy_policies.create')->with('success', 'Политика конфиденциальности успешно обновлена.');
    }
}
