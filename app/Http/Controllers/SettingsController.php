<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\SystemSettings;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = app(SystemSettings::class);
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'required|in:light,dark',
            'font'  => 'required|in:Times New Roman,Merriweather,Georgia',
            'font_size' => 'required|string|in:12px,14px,16px,18px,20px',
        ]);

        /** @var SystemSettings $settings */
        $settings = app(SystemSettings::class);
        $settings->theme = $validated['theme'];
        $settings->font = $validated['font'];
        $settings->font_size = $validated['font_size'];
        $settings->save();

        // Чтобы изменения применились сразу:
        app()->forgetInstance(SystemSettings::class);

        return redirect()->back()->with('success', 'Настройки успешно сохранены!');
    }
}
