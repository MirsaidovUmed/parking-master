<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SystemSettings extends Settings
{
    public string $theme;
    public string $font;
    public string $font_size;

    public static function group(): string
    {
        return 'system';
    }
}
