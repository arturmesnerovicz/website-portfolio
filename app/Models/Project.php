<?php

namespace App\Models;

use App\Traits\HasNorraTranslations;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasNorraTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'category',
        'short_description',
        'full_description',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'client',
        'year',
        'category',
        'short_description',
        'full_description',
        'cover_image',
        'mockup_image',
        'modal_video',
        'highlight_video',
        'gallery',
        'tags',
        'link_url',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * @var list<string>
     */
    protected $appends = [
        'modal_image_url',
        'modal_video_url',
        'cover_image_url',
    ];

    /**
     * Video URL for modal preview (motion, reel, full demo).
     */
    public function getModalVideoUrlAttribute(): ?string
    {
        if (! empty($this->modal_video)) {
            if (str_starts_with($this->modal_video, 'http://') || str_starts_with($this->modal_video, 'https://') || str_starts_with($this->modal_video, '/')) {
                return $this->modal_video;
            }

            return asset('storage/'.$this->modal_video);
        }

        return null;
    }

    /**
     * Full-length project screenshot/image for modal preview.
     */
    public function getModalImageUrlAttribute(): string
    {
        if (! empty($this->mockup_image) && file_exists(public_path('storage/'.$this->mockup_image))) {
            return asset('storage/'.$this->mockup_image);
        }

        if (! empty($this->cover_image) && file_exists(public_path('storage/'.$this->cover_image))) {
            return asset('storage/'.$this->cover_image);
        }

        return asset('storage/cta-bg.png');
    }

    /**
     * Project cover image URL for cards.
     */
    public function getCoverImageUrlAttribute(): string
    {
        if (! empty($this->cover_image) && file_exists(public_path('storage/'.$this->cover_image))) {
            return asset('storage/'.$this->cover_image);
        }

        if (! empty($this->mockup_image) && file_exists(public_path('storage/'.$this->mockup_image))) {
            return asset('storage/'.$this->mockup_image);
        }

        return asset('storage/cta-bg.png');
    }
}
