<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.pages.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.pages.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
            'keyword' => 'nullable|string|max:255',
        ]);

        // Şəkil yüklə
        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->optimizeAndStore($request->file('image'), 'banners');
        }

        $validated['status'] = $request->has('status') ? 1 : 0;
        
        // Auto-increment order
        $maxOrder = Banner::max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;

        $banner = Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Баннер успешно добавлен!');
    }

    public function edit(Banner $banner)
    {
        return view('admin.pages.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
            'keyword' => 'nullable|string|max:255',
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

    public function updateOrder(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->order = $request->input('order');
        $banner->save();

        return response()->json(['success' => true]);
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

