<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function index()
    {
        return view('admin.pages.translate.index');
    }

    public function create()
    {
        return view('admin.pages.translate.create');
    }

    public function store(LanguageRequest $request)
    {
        Language::create($request->validated());

        return redirect()->route('admin.translates.index')->with('success', 'Язык успешно добавлен!');
    }
}
