<?php

namespace App\Traits;

use Spatie\Translatable\HasTranslations;

trait HasNorraTranslations
{
    use HasTranslations {
        getTranslation as parentGetTranslation;
    }

    /**
     * Get a translation with seamless raw string fallback for existing database data.
     */
    public function getTranslation(string $attribute, string $locale, bool $useFallbackLocale = true): mixed
    {
        $raw = $this->getAttributes()[$attribute] ?? null;

        // If the attribute contains a plain string (not a JSON structure)
        if (! empty($raw) && ! str_starts_with(trim((string) $raw), '{')) {
            if ($locale !== 'pt_BR' && $locale !== 'pt') {
                $translated = __($raw, [], $locale);
                if ($translated !== $raw) {
                    return $translated;
                }
            }

            return $raw;
        }

        return $this->parentGetTranslation($attribute, $locale, $useFallbackLocale);
    }
}
