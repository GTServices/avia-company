<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public function optimizeAndStore($image, $folder)
    {
        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $path = "{$folder}/{$fileName}";

        $imgData = file_get_contents($image->getRealPath());
        $optimized = $this->optimizeImage($imgData, $image->getClientOriginalExtension());

        Storage::disk('public')->put($path, $optimized);

        return $path;
    }

    private function optimizeImage($data, $extension)
    {
        $extension = strtolower($extension);
        $image = @imagecreatefromstring($data);
        if (!$image) return $data;

        ob_start();
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($image, null, 85);
                break;
            case 'png':
                imagepng($image, null, 8);
                break;
            case 'gif':
                imagegif($image);
                break;
            case 'webp':
                imagewebp($image, null, 85);
                break;
            default:
                ob_end_clean();
                imagedestroy($image);
                return $data;
        }
        $out = ob_get_clean();
        imagedestroy($image);
        return $out;
    }
}
