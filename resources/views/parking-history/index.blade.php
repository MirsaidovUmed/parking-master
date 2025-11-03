@extends('layouts.app')
@section('title-page', 'История парковок')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 d-flex justify-content-between align-items-center">
                    История парковок
                </h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Гос.номер</th>
                                <th>Дата въезда</th>
                                <th>Дата выезда</th>
                                <th>Цена</th>
                                <th>Время оплаты</th>
                                <th>Фото машины</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($parkingHistory as $history)
                            <tr>
                                <td>{{ $history->plate_number }}</td>
                                <td>{{ $history->status_in_time?->format('d.m.Y H:i') }}</td>
                                <td>{{ $history->status_out_time?->format('d.m.Y H:i') ?? '—' }}</td>
                                <td>{{ $history->payment_amount }}</td>
                                <td>{{ $history->p2 }}</td>
                                <td>
                                    @if($history->image_plate_path_out)
                                        <a href="{{ asset($history->image_plate_path_out) }}" download>
                                            <img src="{{ asset($history->image_plate_path_out) }}"
                                                alt="Фото"
                                                style="width: 80px; height: auto; border-radius: 6px;">
                                        </a>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-left">
                        {{ $parkingHistory->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
