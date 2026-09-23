<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Interact with the service deliverables attribute.
     *
     * @return Attribute<array<string>, array<string>|string|null>
     */
    protected function deliverables(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (empty($value)) {
                    return [];
                }

                if (is_array($value)) {
                    return array_values($value);
                }

                if (is_string($value)) {
                    $decoded = json_decode($value, true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        if (is_array($decoded)) {
                            return array_values($decoded);
                        }

                        if (is_string($decoded)) {
                            return array_values(array_filter(array_map('trim', explode(',', $decoded))));
                        }
                    }

                    // Fallback if not valid JSON: treat as comma-separated string
                    return array_values(array_filter(array_map('trim', explode(',', $value))));
                }

                return [];
            },
            set: function ($value) {
                if (is_array($value)) {
                    return json_encode(array_values(array_filter($value)));
                }

                if (is_string($value)) {
                    $items = array_values(array_filter(array_map('trim', explode(',', $value))));

                    return json_encode($items);
                }

                return json_encode([]);
            },
        );
    }
}
