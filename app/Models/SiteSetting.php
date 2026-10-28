<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'label',
        'description',
    ];

    /**
     * Get a setting value by key with optional fallback.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::query()->where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): self
    {
        return static::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : $value,
                'group' => $group,
                'type' => $type,
            ]
        );
    }

    /**
     * Get all settings mapped by key, automatically resolving locale variants (e.g. key_en when locale is en).
     *
     * @return array<string, mixed>
     */
    public static function getFormattedSettings(?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();
        $all = static::query()->pluck('value', 'key')->toArray();

        $settings = [];
        foreach ($all as $key => $val) {
            if (str_ends_with($key, '_en')) {
                continue;
            }

            if ($locale === 'en' && ! empty($all[$key.'_en'])) {
                $settings[$key] = $all[$key.'_en'];
            } elseif ($locale === 'en' && is_string($val)) {
                $trans = __($val, [], 'en');
                $settings[$key] = $trans;
            } else {
                $settings[$key] = $val;
            }
        }

        return $settings;
    }
}
