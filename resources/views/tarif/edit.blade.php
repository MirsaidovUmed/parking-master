@extends('layouts.app')

@section('title-page')
    Редактирование тарифа
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12 col-xl-8 offset-xl-2">
            <div class="bg-secondary rounded h-100 p-4">
                <h5 class="mb-4">Редактирование тарифа</h5>

                <form action="{{ route('tariff.update', $tariff->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Название --}}
                    <div class="mb-3">
                        <label class="form-label">Название тарифа</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $tariff->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Статус --}}
                    <div class="mb-3">
                        <label class="form-label">Статус</label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ old('is_active', $tariff->is_active) == 1 ? 'selected' : '' }}>Активен</option>
                            <option value="0" {{ old('is_active', $tariff->is_active) == 0 ? 'selected' : '' }}>Неактивен</option>
                        </select>
                    </div>

                    {{-- Минута --}}
                    <div class="mb-3">
                        <label class="form-label">Минута</label>
                        <input type="number"
                               name="minute"
                               class="form-control @error('minute') is-invalid @enderror"
                               value="{{ old('minute', $tariff->minute) }}">
                        @error('minute')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Цена (если нет шагов) --}}
                    @if(!$tariff->p0)
                        <div class="mb-3">
                            <label class="form-label">Цена</label>
                            <input type="number"
                                   name="price_per_step"
                                   step="0.01"
                                   class="form-control @error('price_per_step') is-invalid @enderror"
                                   value="{{ old('price_per_step', $tariff->price_per_step) }}">
                            @error('price_per_step')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        {{-- Если шаги есть – выводим их --}}
                        <div class="mb-3">
                            <label class="form-label">Шаги тарифа</label>
                            @for($i = 0; $i <= 10; $i++)
                                @php
                                    $stepData = $tariff["p{$i}"] ? json_decode($tariff["p{$i}"], true) : null;
                                @endphp
                                @if($stepData)
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <input type="text"
                                                   name="p{{ $i }}"
                                                   class="form-control"
                                                   value="{{ old("p{$i}", $stepData['time']) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number"
                                                   name="price_per_step{{ $i }}"
                                                   step="0.01"
                                                   class="form-control"
                                                   value="{{ old("price_per_step{$i}", $stepData['price_per_step']) }}">
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{ route('tariff.index') }}" class="btn btn-secondary">Назад</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
