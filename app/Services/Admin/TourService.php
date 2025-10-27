<?php

namespace App\Services\Admin;

use App\Models\Tour;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TourService
{
    public function __construct(private ImageService $imageService)
    {
    }

   public function storeTour(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|array',
        'title.*' => 'required|string|max:255',
        'desc' => 'required|array',
        'desc.*' => 'required|string',
        'card_description' => 'nullable|array',
        'card_description.*' => 'nullable|string',
        'price' => 'nullable|numeric|min:0',
        'biletstockcount' => 'nullable|integer|min:0',
        'datetime' => 'nullable|date',
        'img' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
        'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
    ]);

    if ($validator->fails()) {
        return ['errors' => $validator->errors()];
    }

    // 🔹 Əsas məlumatlar
    $tourData = [
        'price' => $request->input('price'),
        'biletstockcount' => $request->input('biletstockcount'),
        'datetime' => $request->input('datetime'),
        'status' => $request->has('status') ? 1 : 0,
        'title' => [], // 🧠 boş translatable sahələr
        'desc'  => [],
        'card_description' => [],
    ];

    // 🔹 Şəkil varsa optimallaşdır və saxla
    if ($request->hasFile('img')) {
        $tourData['img'] = $this->imageService->optimizeAndStore($request->file('img'), 'tours');
    }

    // 🔹 Banner şəkil varsa optimallaşdır və saxla
    if ($request->hasFile('banner_image')) {
        $tourData['banner_image'] = $this->imageService->optimizeAndStore($request->file('banner_image'), 'tours');
    }

    // 🔹 Translatable datanı `create`-dən əvvəl birləşdir
    foreach ($request->input('title') as $locale => $value) {
        $tourData['title'][$locale] = $value;
    }
    foreach ($request->input('desc') as $locale => $value) {
        $tourData['desc'][$locale] = $value;
    }
    if ($request->has('card_description')) {
        foreach ($request->input('card_description') as $locale => $value) {
            $tourData['card_description'][$locale] = $value;
        }
    }

    // 🔹 Artıq `create()` birbaşa JSON kimi yazır (Spatie bunu avtomatik serialize edir)
    $tour = Tour::create($tourData);

    return ['success' => true, 'tour' => $tour];
}


    public function updateTour(Request $request, Tour $tour)
    {

        // 🔹 Validasiyalar
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|array',
                'title.*' => 'required|string|max:255',
                'desc' => 'required|array',
                'desc.*' => 'required|string',
                'card_description' => 'nullable|array',
                'card_description.*' => 'nullable|string',
                'price' => 'nullable|numeric|min:0',
                'biletstockcount' => 'nullable|integer|min:0',
                'datetime' => 'nullable|date',
                'img' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
                'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
                'status' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        // 🔹 Şəkil yenilənməsi
        if ($request->hasFile('img')) {
            if ($tour->img && Storage::disk('public')->exists($tour->img)) {
                Storage::disk('public')->delete($tour->img);
            }

            $tour->img = $this->imageService->optimizeAndStore($request->file('img'), 'tours');
        }

        // 🔹 Banner şəkil yenilənməsi
        if ($request->hasFile('banner_image')) {
            if ($tour->banner_image && Storage::disk('public')->exists($tour->banner_image)) {
                Storage::disk('public')->delete($tour->banner_image);
            }

            $tour->banner_image = $this->imageService->optimizeAndStore($request->file('banner_image'), 'tours');
        }

        // 🔹 Əsas məlumatlar
        $tour->price = $request->input('price');
        $tour->biletstockcount = $request->input('biletstockcount');
        $tour->datetime = $request->input('datetime');
        $tour->status = $request->has('status') ? 1 : 0;
        // 🔹 Tərcümələr
        foreach ($request->input('title') as $locale => $value) {
            $tour->setTranslation('title', $locale, $value);
        }

        foreach ($request->input('desc') as $locale => $value) {
            $tour->setTranslation('desc', $locale, $value);
        }

        if ($request->has('card_description')) {
            foreach ($request->input('card_description') as $locale => $value) {
                $tour->setTranslation('card_description', $locale, $value);
            }
        }

        $tour->save();

        return ['success' => true, 'tour' => $tour];
    }

    public function deleteTour($id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->img && Storage::disk('public')->exists($tour->img)) {
            Storage::disk('public')->delete($tour->img);
        }

        $tour->delete();

        return ['success' => true];
    }

    public function deleteSelectedTours(array $ids)
    {
        $tours = Tour::whereIn('id', $ids)->get();

        foreach ($tours as $tour) {
            if ($tour->img && Storage::disk('public')->exists($tour->img)) {
                Storage::disk('public')->delete($tour->img);
            }
        }

        Tour::whereIn('id', $ids)->delete();

        return ['success' => true];
    }
}
