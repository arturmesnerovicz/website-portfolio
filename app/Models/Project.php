<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
        'gallery',
        'tags',
        'link_url',
        'is_featured',
        'sort_order',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];
}
