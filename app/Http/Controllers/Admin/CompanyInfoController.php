<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository)
    {

    }
    public function create()
    {
        $languages = $this->languageRepository->all("order", 'asc');
        return view('admin.pages.company_info.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'favicon' => 'nullable|image',
            'image' => 'nullable|image',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'email_2' => 'nullable|email',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|array',
            'address.*' => 'nullable|string',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'copyright_text' => 'nullable|array',
            'copyright_text.*' => 'nullable|string',
        ]);

        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('company_info', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('company_info', 'public');
        }

        $companyInfo = new CompanyInfo();
        $companyInfo->fill($validated);
        $companyInfo->save();

        return redirect()->route('admin.company_info.create')->with('success', 'Информация о компании успешно добавлена.');
    }

    public function edit()
    {
        $companyInfo = CompanyInfo::first();
        $languages = $this->languageRepository->all("order", 'asc');
        return view('admin.pages.company_info.edit', compact('companyInfo', 'languages'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'favicon' => 'nullable|image',
            'image' => 'nullable|image',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'email_2' => 'nullable|email',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|array',
            'address.*' => 'nullable|string',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'copyright_text' => 'nullable|array',
            'copyright_text.*' => 'nullable|string',
        ]);

        $companyInfo = CompanyInfo::firstOrNew([]);

        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('company_info', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('company_info', 'public');
        }

        $companyInfo->fill($validated);
        $companyInfo->save();

        return redirect()->back()->with('success', 'Информация о компании успешно обновлена.');
    }
}
