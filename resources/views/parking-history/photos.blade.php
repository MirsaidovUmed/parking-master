@extends('layouts.app')
@section('title-page', 'Фотофиксация')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 d-flex justify-content-between align-items-center">
                    Фотофиксация для {{ $event->plate_number }}
                    <a href="{{ route('parking-history.downloadAll', $event->id) }}" class="btn btn-sm btn-primary">
                        Скачать все фото (ZIP)
                    </a>
                </h6>

                <div class="row g-4">
                    @foreach ([
                        'Фото при въезде (полное)' => $event->image_full_path_in,
                        'Фото при въезде (номер)' => $event->image_plate_path_in,
                        'Фото при выезде (полное)' => $event->image_full_path_out,
                        'Фото при выезде (номер)' => $event->image_plate_path_out,
                    ] as $title => $photo)
                        <div class="col-md-6">
                            <div class="photo-card bg-dark rounded position-relative overflow-hidden shadow-sm">
                                <div class="photo-header p-2 bg-dark text-light text-center border-bottom border-secondary">
                                    <strong>{{ $title }}</strong>
                                </div>
                                <div class="photo-body d-flex justify-content-center align-items-center bg-black">
                                    @if($photo)
                                        <a href="{{ asset(ltrim($photo, '/')) }}" target="_blank" class="w-100 h-100 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset(ltrim($photo, '/')) }}" class="photo-img rounded" alt="{{ $title }}">
                                        </a>
                                    @else
                                        <p class="text-light m-0">Нет данных</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Стили прямо в Blade для наглядности, можно вынести в CSS --}}
<style>
    .photo-card {
        height: 300px; /* фиксированная высота блока */
        display: flex;
        flex-direction: column;
    }
    .photo-header {
        flex: 0 0 auto;
    }
    .photo-body {
        flex: 1 1 auto;
        overflow: hidden;
        position: relative;
    }
    .photo-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* сохраняет пропорции */
        transition: transform 0.3s ease;
    }
    .photo-card:hover .photo-img {
        transform: scale(1.05); /* лёгкий эффект при наведении */
    }
</style>
@endsection
