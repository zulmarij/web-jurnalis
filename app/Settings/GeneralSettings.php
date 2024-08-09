<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_description;
    public ?string $site_logo;
    public ?string $site_favicon;
    public array $site_colors;

    public static function group(): string
    {
        return 'general';
    }
}
