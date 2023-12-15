<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TranslationHelper
{
    public static string $defaultLocale = 'en';

    public static array $availableLocales = [
        'en',
        'ar',
        'fr',
    ];

    public static function generateFakeTranslatedInput(string $functionName = 'name'): array
    {
        $translatedName = [];
        foreach (self::$availableLocales as $locale) {
            $fakeName = fake($locale)->{$functionName}();
            $translatedName[$locale] = $fakeName;
        }

        return $translatedName;
    }

    public static function generateFakeTranslatedNameAndSlug(array &$translatedName, array &$translatedSlug): void
    {
        foreach (self::$availableLocales as $locale) {
            $fakeName = fake($locale)->name();
            $translatedName[$locale] = $fakeName;
            $translatedSlug[$locale] = Str::slug($fakeName);
        }
    }
}
