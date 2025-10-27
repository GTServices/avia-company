<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Repositories\LanguageRepository;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function __construct(private LanguageRepository $languageRepository, private ImageService $imageService)
    {
    }

    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.pages.banners.index', compact('banners'));
    }

    public function create()
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.banners.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
            'keyword' => 'nullable|array',
            'keyword.*' => 'nullable|string',
            'status' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        // Şəkil yüklə
        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->optimizeAndStore($request->file('image'), 'banners');
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        $banner = Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Баннер успешно добавлен!');
    }

    public function edit(Banner $banner)
    {
        $languages = $this->languageRepository->all('order', 'asc');
        return view('admin.pages.banners.edit', compact('banner', 'languages'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
            'keyword' => 'nullable|array',
            'keyword.*' => 'nullable|string',
            'status' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        // Şəkil yenilə
        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $validated['image'] = $this->imageService->optimizeAndStore($request->file('image'), 'banners');
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Баннер успешно обновлен!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Баннер удален!');
    }
}

