<?php

namespace App\Services;

class ImageService
{
    public function optimizeAndStore($image, $folder)
    {
        // Create a unique file name
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Set the storage path (use relative path for the folder)
        $folder = trim($folder, '/'); // Ensure no leading/trailing slashes
        $path = storage_path("app/public/{$folder}/{$fileName}");

        // Create the directory if it doesn't exist
        $directory = storage_path("app/public/{$folder}");
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Open the image file
        $imgData = file_get_contents($image->getRealPath());

        // Minify and optimize
        $optimizedImage = $this->optimizeImage($imgData, $image->getClientOriginalExtension());

        // Store the optimized image
        file_put_contents($path, $optimizedImage);

        return "{$folder}/{$fileName}";
    }


    private function optimizeImage($data, $extension)
    {
        switch (strtolower($extension)) {
            case 'jpeg':
            case 'jpg':
                return $this->optimizeJpeg($data);
            case 'png':
                return $this->optimizePng($data);
            case 'gif':
                return $this->optimizeGif($data);
            case 'bmp':
                return $this->optimizeBmp($data);
            case 'webp':
                return $this->optimizeWebp($data);
            case 'tiff':
            case 'tif':
                return $this->optimizeTiff($data);
            default:
                return $data; // If unsupported format, return as is
        }
    }

    private function optimizeJpeg($data)
    {
        $image = imagecreatefromstring($data);
        ob_start();
        imagejpeg($image, null, 85); // 85% quality
        $optimizedData = ob_get_clean();
        imagedestroy($image);
        return $optimizedData;
    }

    private function optimizePng($data)
    {
        $image = imagecreatefromstring($data);
        ob_start();
        imagepng($image, null, 8); // Compression level 8
        $optimizedData = ob_get_clean();
        imagedestroy($image);
        return $optimizedData;
    }

    private function optimizeGif($data)
    {
        $image = imagecreatefromstring($data);
        ob_start();
        imagegif($image);
        $optimizedData = ob_get_clean();
        imagedestroy($image);
        return $optimizedData;
    }

    private function optimizeBmp($data)
    {
        $image = imagecreatefromstring($data);
        ob_start();
        imagebmp($image);
        $optimizedData = ob_get_clean();
        imagedestroy($image);
        return $optimizedData;
    }

    private function optimizeWebp($data)
    {
        $image = imagecreatefromstring($data);
        ob_start();
        imagewebp($image, null, 85); // 85% quality
        $optimizedData = ob_get_clean();
        imagedestroy($image);
        return $optimizedData;
    }

    private function optimizeTiff($data)
    {
        // TIFF support is limited in GD, return the data as is
        return $data;
    }
}
