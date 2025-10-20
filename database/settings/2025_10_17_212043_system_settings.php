<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('system.theme', 'dark');
        $this->migrator->add('system.font', 'Inter');
        $this->migrator->add('system.font_size', '16px');
    }
};
