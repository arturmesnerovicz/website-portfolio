<?php

namespace App\Models;

use App\Traits\HasNorraTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product3dModel extends Model
{
    use HasNorraTranslations;

    /**
     * @var string
     */
    protected $table = 'product3d_models';

    /**
     * @var list<string>
     */
    public array $translatable = [
        'name',
        'badge',
        'subtitle',
        'description',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'badge',
        'subtitle',
        'description',
        'glb_file',
        'thumbnail',
        'is_active',
        'is_initial',
        'sort_order',
        'camera_settings',
        'transform_settings',
        'parts',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_initial' => 'boolean',
        'sort_order' => 'integer',
        'camera_settings' => 'array',
        'transform_settings' => 'array',
        'parts' => 'array',
    ];

    /**
     * @var list<string>
     */
    protected $appends = [
        'glb_url',
        'thumbnail_url',
    ];

    /**
     * Get a localized attribute with robust fallbacks for pt/pt_BR and en.
     */
    public function getNorraTranslation(string $attribute, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $translations = $this->getTranslations($attribute);

        if (! empty($translations)) {
            if (isset($translations[$locale]) && ! empty($translations[$locale])) {
                return (string) $translations[$locale];
            }

            if (str_starts_with($locale, 'pt')) {
                if (! empty($translations['pt_BR'])) {
                    return (string) $translations['pt_BR'];
                }
                if (! empty($translations['pt'])) {
                    return (string) $translations['pt'];
                }
            }

            if (str_starts_with($locale, 'en') && ! empty($translations['en'])) {
                return (string) $translations['en'];
            }

            foreach ($translations as $val) {
                if (! empty($val)) {
                    return (string) $val;
                }
            }
        }

        $raw = $this->getAttributes()[$attribute] ?? '';
        if (! is_string($raw) || empty($raw)) {
            return '';
        }

        if (str_starts_with(trim($raw), '{')) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                if (! empty($decoded[$locale])) {
                    return (string) $decoded[$locale];
                }
                if (str_starts_with($locale, 'pt') && ! empty($decoded['pt_BR'])) {
                    return (string) $decoded['pt_BR'];
                }
                if (str_starts_with($locale, 'en') && ! empty($decoded['en'])) {
                    return (string) $decoded['en'];
                }
                foreach ($decoded as $val) {
                    if (! empty($val)) {
                        return (string) $val;
                    }
                }

                return '';
            }
        }

        return $raw;
    }

    /**
     * Get the public URL for the GLB 3D model.
     */
    public function getGlbUrlAttribute(): ?string
    {
        if (empty($this->glb_file)) {
            return null;
        }

        if (str_starts_with($this->glb_file, 'http://') || str_starts_with($this->glb_file, 'https://') || str_starts_with($this->glb_file, '/')) {
            return $this->glb_file;
        }

        $url = Storage::disk('public')->url($this->glb_file);
        $path = parse_url($url, PHP_URL_PATH);

        return $path ?: $url;
    }

    /**
     * Get the public URL for the thumbnail image.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (empty($this->thumbnail)) {
            return null;
        }

        if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://') || str_starts_with($this->thumbnail, '/')) {
            return $this->thumbnail;
        }

        $url = Storage::disk('public')->url($this->thumbnail);
        $path = parse_url($url, PHP_URL_PATH);

        return $path ?: $url;
    }

    /**
     * Format model data into a clean structure for the Three.js configurator frontend.
     *
     * @return array<string, mixed>
     */
    public function toFrontendPayload(): array
    {
        $locale = app()->getLocale();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->getNorraTranslation('name', $locale),
            'badge' => $this->getNorraTranslation('badge', $locale) ?: null,
            'subtitle' => $this->getNorraTranslation('subtitle', $locale) ?: null,
            'description' => $this->getNorraTranslation('description', $locale) ?: null,
            'modelUrl' => $this->glb_url,
            'thumbnailUrl' => $this->thumbnail_url,
            'cameraSettings' => array_merge([
                'position' => [0, 0, 4.2],
                'distance' => 4.2,
                'fov' => 40,
                'target' => [0, 0, 0],
                'allowZoom' => isset($this->camera_settings['allow_zoom'])
                    ? (bool) $this->camera_settings['allow_zoom']
                    : (isset($this->camera_settings['allowZoom']) ? (bool) $this->camera_settings['allowZoom'] : true),
                'autoRotate' => true,
            ], $this->camera_settings ?? [], [
                'allowZoom' => isset($this->camera_settings['allow_zoom'])
                    ? (bool) $this->camera_settings['allow_zoom']
                    : (isset($this->camera_settings['allowZoom']) ? (bool) $this->camera_settings['allowZoom'] : true),
            ]),
            'transformSettings' => array_merge([
                'scale' => 1.0,
                'rotation' => [0.12, -0.35, 0],
                'position' => [0, 0.1, 0],
            ], $this->transform_settings ?? []),
            'parts' => is_array($this->parts) ? array_values(array_map(function ($part, $partIdx) {
                $partName = trim($part['name'] ?? 'Part '.($partIdx + 1));
                $partId = ! empty($part['id']) ? $part['id'] : Str::slug($partName ?: 'part-'.$partIdx);

                $options = is_array($part['options'] ?? null) ? $part['options'] : [];
                $hasDefault = collect($options)->contains(fn ($o) => ! empty($o['is_default']));

                return [
                    'id' => $partId,
                    'name' => $partName,
                    'mesh_name' => $part['mesh_name'] ?? '',
                    'type' => $part['type'] ?? 'color',
                    'options' => array_values(array_map(function ($opt, $optIdx) use ($hasDefault) {
                        $texUrl = null;
                        if (! empty($opt['texture'])) {
                            $raw = Storage::disk('public')->url($opt['texture']);
                            $parsedPath = parse_url($raw, PHP_URL_PATH);
                            $texUrl = $parsedPath ?: $raw;
                        }

                        $optName = trim($opt['name'] ?? 'Option '.($optIdx + 1));
                        $optId = ! empty($opt['id']) ? $opt['id'] : Str::slug($optName ?: 'opt-'.$optIdx);

                        return [
                            'id' => $optId,
                            'name' => $optName,
                            'color' => $opt['color'] ?? '#ffffff',
                            'roughness' => isset($opt['roughness']) ? (float) $opt['roughness'] : 0.3,
                            'metalness' => isset($opt['metalness']) ? (float) $opt['metalness'] : 0.0,
                            'material_type' => $opt['material_type'] ?? 'physical',
                            'texture_url' => $texUrl,
                            'is_default' => ! empty($opt['is_default']) || (! $hasDefault && $optIdx === 0),
                        ];
                    }, $options, array_keys($options))),
                ];
            }, $this->parts, array_keys($this->parts))) : [],
        ];
    }
}
