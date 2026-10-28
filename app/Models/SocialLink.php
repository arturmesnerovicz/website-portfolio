<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'platform',
        'label',
        'url',
        'icon',
        'sort_order',
        'is_active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
