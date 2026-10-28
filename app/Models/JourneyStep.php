<?php

namespace App\Models;

use App\Traits\HasNorraTranslations;
use Illuminate\Database\Eloquent\Model;

class JourneyStep extends Model
{
    use HasNorraTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'subtitle',
        'description',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'step_num',
        'title',
        'subtitle',
        'description',
        'deliverables',
        'media_type',
        'image_path',
        'video_path',
        'sort_order',
        'is_active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'deliverables' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
