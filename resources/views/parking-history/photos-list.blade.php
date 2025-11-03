@extends('layouts.app')
@section('title-page', 'Фотофиксация')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Фотофиксация</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Гос.номер</th>
                                <th>Дата въезда</th>
                                <th>Дата выезда</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->plate_number }}</td>
                                <td>{{ $event->status_in_time?->format('d.m.Y H:i') }}</td>
                                <td>{{ $event->status_out_time?->format('d.m.Y H:i') ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('parking_history.photos', $event->id) }}" class="btn btn-sm btn-primary">
                                        Смотреть фото
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-left">
                        {{ $events->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
