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

                <div class="row">
                    @foreach ([
                        'Фото при въезде (полное)' => $event->image_full_path_in,
                        'Фото при въезде (номер)' => $event->image_plate_path_in,
                        'Фото при выезде (полное)' => $event->image_full_path_out,
                        'Фото при выезде (номер)' => $event->image_plate_path_out,
                    ] as $title => $photo)
                        <div class="col-md-6 mb-4">
                            <h6>{{ $title }}</h6>
                            @if($photo)
                                <a href="{{ asset($photo) }}" target="_blank">
                                    <img src="{{ asset($photo) }}" class="img-fluid rounded border">
                                </a>
                            @else
                                <p>Нет данных</p>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
