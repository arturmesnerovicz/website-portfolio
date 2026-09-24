<?php

namespace App\Models;

use App\Traits\HasNorraTranslations;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasNorraTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'subtitle',
        'badge_text',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'badge_text',
        'order',
        'is_active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
