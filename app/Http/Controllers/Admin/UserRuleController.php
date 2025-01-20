<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRule;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class UserRuleController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository) {}

    public function create()
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.user_rules.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        UserRule::create($data);

        return redirect()->route('admin.user_rules.create')->with('success', 'Правила успешно добавлены.');
    }

    public function edit(UserRule $userRule)
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.user_rules.edit', compact('userRule', 'languages'));
    }

    public function update(Request $request, UserRule $userRule)
    {
        $data = $request->all();

        $userRule->update($data);

        return redirect()->back()->with('success', 'Правила успешно обновлены.');
    }
}
