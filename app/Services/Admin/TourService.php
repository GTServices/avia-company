<?php

namespace App\Services\Admin;

use App\Models\Tour;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourService
{
    public function __construct(private ImageService $imageService)
    {
    }



    public function storeTour(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
        ], [
            'price.required' => 'Поле "Цена" обязательно для заполнения.',
            'price.numeric' => 'Поле "Цена" должно быть числом.',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        // Handle image upload
        $tourData = [];
        if ($request->hasFile('img')) {
            $imagePath = $this->imageService->optimizeAndStore($request->file('img'), 'tours');
            $tourData['img'] = $imagePath;
        }

        // Set basic fields
        $tourData['price'] = $request->input('price');
        $tourData['datetime'] = $request->input('datetime');
        $tourData['status'] = $request->has('status') ? 1 : 0;

        // Create the tour
        $tour = Tour::create($tourData);

        // Save translations
        foreach ($request->input('title') as $locale => $title) {
            $tour->setTranslation('title', $locale, $title);
        }

        foreach ($request->input('desc') as $locale => $desc) {
            $tour->setTranslation('desc', $locale, $desc);
        }

        $tour->save();

        return ['success' => true, 'tour' => $tour];
    }

    public function updateTour(Request $request, Tour $tour)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
        ], [
            'price.required' => 'Поле "Цена" обязательно для заполнения.',
            'price.numeric' => 'Поле "Цена" должно быть числом.',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        // Handle image upload
        if ($request->hasFile('img')) {
            $imagePath = $this->imageService->optimizeAndStore($request->file('img'), 'tours');
            $tour->img = $imagePath;
        }

        // Update basic fields
        $tour->price = $request->input('price');
        $tour->datetime = $request->input('datetime');
        $tour->status = $request->has('status') ? 1 : 0;

        // Update translations
        foreach ($request->input('title') as $locale => $title) {
            $tour->setTranslation('title', $locale, $title);
        }

        foreach ($request->input('desc') as $locale => $desc) {
            $tour->setTranslation('desc', $locale, $desc);
        }

        $tour->save();

        return ['success' => true, 'tour' => $tour];
    }

    public function deleteTour($id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->img && \Storage::exists($tour->img)) {
            \Storage::delete($tour->img);
        }

        $tour->delete();

        return ['success' => true];
    }

    public function deleteSelectedTours(array $ids)
    {
        $tours = Tour::whereIn('id', $ids)->get();

        foreach ($tours as $tour) {
            if ($tour->img && \Storage::exists($tour->img)) {
                \Storage::delete($tour->img);
            }
        }

        Tour::whereIn('id', $ids)->delete();

        return ['success' => true];
    }
}
