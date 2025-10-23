<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourImageController extends Controller
{
    public function store(Request $request, Tour $tour)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        $imagePath = $request->file('image')->store('tours', 'public');
        
        $image = $tour->images()->create([
            'image' => $imagePath,
            'order' => $tour->images()->count()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'image' => [
                'id' => $image->id,
                'url' => $image->image_url,
                'order' => $image->order
            ]
        ]);
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

        return response()->json([
            'success' => true,
            'message' => 'Images reordered successfully'
        ]);
    }

    public function destroy(Tour $tour, $imageId)
    {
        $image = $tour->images()->findOrFail($imageId);
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
