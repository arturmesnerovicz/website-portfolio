<?php

namespace App\Models;

use App\Traits\HasNorraTranslations;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasNorraTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'question',
        'answer',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'question',
        'answer',
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
