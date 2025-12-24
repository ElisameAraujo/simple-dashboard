<?php

namespace App\Helpers\Support;

class LocaleResolver
{
    /**
     * Internal locale cache resolved.
     */
    protected static ?string $resolvedLocale = null;
    protected static string $defaultLocaleKey = 'app.locale';

    /**
     *`resolveLocale`:
     * Normalizes the locale to the "xx_YY" pattern (e.g., pt_BR, en_US).
     *
     * @param string|null $locale Locale informado manualmente
     * @return string Locale resolvido
     */
    public static function resolveLocale(?string $locale = null): string
    {
        //1. Manual locale always takes priority.
        if ($locale) {
            return self::normalize($locale);
        }

        // 2. If already resolved it before, return it from the cache.
        if (self::$resolvedLocale !== null) {
            return self::$resolvedLocale;
        }

        // 3. Resolve from the app
        $appLocale = config(self::$defaultLocaleKey, env('APP_LOCALE', 'en_US'));

        // 4. Normalizes and saves to cache.
        self::$resolvedLocale = self::normalize($appLocale);

        return self::$resolvedLocale;
    }

    /**
     * `normalize`:
     * Converts "pt-br" → "pt_BR", "EN-us" → "en_US"
     */
    protected static function normalize(string $locale): string
    {
        $locale = str_replace('-', '_', $locale);
        $locale = strtolower($locale);

        if (str_contains($locale, '_')) {
            [$lang, $region] = explode('_', $locale, 2);
            return strtolower($lang) . '_' . strtoupper($region);
        }

        return strtolower($locale);
    }
}
