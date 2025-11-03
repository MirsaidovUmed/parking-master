@extends('layouts.app')
@section('title-page')
    Главная страница
@endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    {{-- === Ряд со статистикой === --}}
    <div class="row g-4 mb-4">

        {{-- 🚗 Машины за сегодня --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4 h-100">
                <i class="fa fa-car fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Машины сегодня</p>
                    <h6 class="mb-0">{{ $zaezdCountCurrDay ?? 0 }}</h6>
                </div>
            </div>
        </div>

        {{-- 🚗 Машины за месяц --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4 h-100">
                <i class="fa fa-calendar-alt fa-3x text-info"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Машины за месяц</p>
                    <h6 class="mb-0">{{ $zaezdCountMonth ?? 0 }}</h6>
                </div>
            </div>
        </div>

        {{-- 💰 Доход за сегодня --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4 h-100">
                <i class="fa fa-coins fa-3x text-success"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Доход сегодня</p>
                    <h6 class="mb-0">{{ number_format($sumCurrDayDisplay ?? 0, 2, '.', ' ') }} сом</h6>
                </div>
            </div>
        </div>

        {{-- 💰 Доход за месяц --}}
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4 h-100">
                <i class="fa fa-wallet fa-3x text-warning"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Доход за месяц</p>
                    <h6 class="mb-0">{{ number_format($sumMonthDisplay ?? 0, 2, '.', ' ') }} сом</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-14">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="card-header"><h4>Последние 5 машин</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center fs-5">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-nowrap">Гос.номер</th>
                                    <th class="text-nowrap">Дата въезда</th>
                                    <th class="text-nowrap">Дата выезда</th>
                                    <th class="text-nowrap">Цена</th>
                                    <th class="text-nowrap">Время оплаты</th>
                                    <th class="text-nowrap">Фото</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lastCars as $car)
                                    <tr>
                                        <td class="fw-bold">{{ $car->plate_number }}</td>
                                        <td>{{ $car->status_in_time?->format('d.m.Y H:i') }}</td>
                                        <td>{{ $car->status_out_time?->format('d.m.Y H:i') ?? '—' }}</td>
                                        <td>{{ $car->payment_display }}</td>
                                        <td>{{ $car->p2 }}</td>
                                        <td>
                                            @if($car->image_plate_path_out)
                                                <div class="d-flex flex-column align-items-center">
                                                    <a href="{{ asset($car->image_plate_path_out) }}" target="_blank" class="mb-2">
                                                        <img src="{{ asset($car->image_plate_path_out) }}"
                                                            alt="Фото"
                                                            class="img-thumbnail border-0 shadow-sm"
                                                            style="width: 120px; height: auto; border-radius: 8px;">
                                                    </a>
                                                    {{-- <a href="{{ asset($car->image_plate_path_out) }}" download class="btn btn-sm btn-outline-light">
                                                        Скачать
                                                    </a> --}}
                                                </div>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
