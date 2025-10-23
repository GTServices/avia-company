<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TourImageController extends Controller
{
    /**
     * Display the tour images management page.
     */
    public function index(Tour $tour)
    {
        $tour->load(['images' => function($query) {
            $query->orderBy('order');
        }]);
        return view('admin.pages.tours.images', compact('tour'));
    }

    public function store(Request $request, Tour $tour)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        $order = $tour->images()->count();
        $uploadedCount = 0;

        try {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('tours', 'public');
                    
                    $tour->images()->create([
                        'image' => $imagePath,
                        'order' => $order++
                    ]);
                    
                    $uploadedCount++;
                }
            }

            return redirect()
                ->route('admin.tours.images.index', $tour->id)
                ->with('success', "Успешно загружено изображений: $uploadedCount");
                
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.tours.images.index', $tour->id)
                ->with('error', 'Ошибка при загрузке изображений: ' . $e->getMessage());
        }
    }

    public function reorder(Request $request, Tour $tour)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:tour_images,id',
            'images.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->images as $imageData) {
            $tour->images()
                ->where('id', $imageData['id'])
                ->update(['order' => $imageData['order']]);
        }

        return redirect()
            ->route('admin.tours.images.index', $tour->id)
            ->with('success', 'Порядок изображений обновлен');
    }

    public function destroy(Tour $tour, $imageId)
    {
        $image = $tour->images()->findOrFail($imageId);
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return redirect()
            ->route('admin.tours.images.index', $tour->id)
            ->with('success', 'Изображение успешно удалено');
    }
}
