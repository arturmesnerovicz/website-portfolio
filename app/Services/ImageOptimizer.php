<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Optimizes, resizes, and converts an uploaded image to WebP with strict quality and size control.
     *
     * @return string Relative storage path (e.g. "projects/timestamp_slug.webp")
     */
    public static function optimizeAndStore(
        UploadedFile $file,
        string $folder = 'projects',
        int $maxDimension = 4000,
        int $quality = 92
    ): string {
        $realPath = $file->getRealPath();
        if (! $realPath || ! file_exists($realPath)) {
            return $file->store($folder, 'public');
        }

        $mime = $file->getMimeType() ?: '';
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        if (! in_array($mime, $allowedMimes, true) || ! function_exists('imagewebp')) {
            return $file->store($folder, 'public');
        }

        $image = match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($realPath),
            'image/png' => @imagecreatefrompng($realPath),
            'image/webp' => @imagecreatefromwebp($realPath),
            default => false,
        };

        if (! $image) {
            return $file->store($folder, 'public');
        }

        $width = imagesx($image);
        $height = imagesy($image);

        // Proportional downscaling only if exceeding max dimension
        $maxSide = max($width, $height);
        $scale = $maxSide > $maxDimension ? ($maxDimension / $maxSide) : 1.0;
        $newWidth = max(1, (int) round($width * $scale));
        $newHeight = max(1, (int) round($height * $scale));

        $output = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($output, false);
        imagesavealpha($output, true);

        imagecopyresampled(
            $output,
            $image,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $width,
            $height
        );

        $cleanOriginalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $slug = Str::slug($cleanOriginalName) ?: 'image';
        $filename = "{$folder}/".time()."_{$slug}.webp";

        $fullDestinationPath = Storage::disk('public')->path($filename);
        $directory = dirname($fullDestinationPath);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $saved = imagewebp($output, $fullDestinationPath, $quality);

        imagedestroy($image);
        imagedestroy($output);

        if (! $saved) {
            return $file->store($folder, 'public');
        }

        return $filename;
    }
}
