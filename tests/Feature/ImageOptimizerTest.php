<?php

namespace Tests\Feature;

use App\Services\ImageOptimizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageOptimizerTest extends TestCase
{
    public function test_it_optimizes_resizes_and_converts_image_to_webp(): void
    {
        ini_set('memory_limit', '512M');
        Storage::fake('public');

        if (! extension_loaded('gd') || ! function_exists('imagewebp')) {
            $file = UploadedFile::fake()->create('website-full-preview.png', 100, 'image/png');
            $storedPath = ImageOptimizer::optimizeAndStore($file, 'projects', 1200, 92);

            $this->assertStringStartsWith('projects/', $storedPath);
            Storage::disk('public')->assertExists($storedPath);

            return;
        }

        // Create a 2000x1000 fake PNG image with maxDimension 1200
        $file = UploadedFile::fake()->image('website-full-preview.png', 2000, 1000);

        $storedPath = ImageOptimizer::optimizeAndStore($file, 'projects', 1200, 92);

        $this->assertStringStartsWith('projects/', $storedPath);
        $this->assertStringEndsWith('.webp', $storedPath);
        Storage::disk('public')->assertExists($storedPath);

        // Verify dimensions were proportionally downscaled to max 1200px
        $fullPath = Storage::disk('public')->path($storedPath);
        $size = getimagesize($fullPath);

        $this->assertNotFalse($size);
        $this->assertLessThanOrEqual(1200, $size[0]);
        $this->assertLessThanOrEqual(1200, $size[1]);
        $this->assertSame('image/webp', $size['mime']);
    }
}
