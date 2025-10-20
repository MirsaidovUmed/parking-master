<?php

use App\Settings\SystemSettings;

if (!function_exists('settings')) {
    function settings(?string $key = null)
    {
        $settings = app(SystemSettings::class);

        // если ключ не передан — вернуть весь объект
        if ($key === null) {
            return $settings;
        }

        // если передан с префиксом "system."
        if (str_starts_with($key, 'system.')) {
            $key = str_replace('system.', '', $key);
        }

        return $settings->{$key} ?? null;
    }
}
