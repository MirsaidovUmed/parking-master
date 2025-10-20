@extends('layouts.app')

@section('title-page', 'Настройки системы')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-8">
                <div class="bg-secondary rounded h-100 p-4">
                    <h5 class="mb-4"><i class="fa fa-cogs me-2"></i>Настройки системы</h5>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="theme" class="form-label">Тема</label>
                            <select class="form-select" name="theme" id="theme">
                                <option value="light" {{ $settings->theme === 'light' ? 'selected' : '' }}>Светлая</option>
                                <option value="dark" {{ $settings->theme === 'dark' ? 'selected' : '' }}>Тёмная</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="font" class="form-label">Шрифт</label>
                            <select class="form-select" name="font" id="font">
                                <option value="Times New Roman" {{ $settings->font === 'Times New Roman' ? 'selected' : '' }}>Times New Roman</option>
                                <option value="Merriweather" {{ $settings->font === 'Merriweather' ? 'selected' : '' }}>Merriweather</option>
                                <option value="Georgia" {{ $settings->font === 'Georgia' ? 'selected' : '' }}>Georgia</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="font_size" class="form-label">Размер шрифта</label>
                            <select class="form-select" name="font_size" id="font_size">
                                <option value="12px" {{ $settings->font_size === '12px' ? 'selected' : '' }}>12px</option>
                                <option value="14px" {{ $settings->font_size === '14px' ? 'selected' : '' }}>14px</option>
                                <option value="16px" {{ $settings->font_size === '16px' ? 'selected' : '' }}>16px</option>
                                <option value="18px" {{ $settings->font_size === '18px' ? 'selected' : '' }}>18px</option>
                                <option value="20px" {{ $settings->font_size === '20px' ? 'selected' : '' }}>20px</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">💾 Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
