<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'order_num',
        'title',
        'category',
        'description',
        'deliverables',
        'is_active',
        'sort_order',
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
