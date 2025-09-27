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
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Банк</th>
                                <th>ID оплаты</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($parkingHistory as $history)
                            <tr>
                                <td>{{ $history->plate_number }}</td>
                                <td>{{ $history->payment_amount }}</td>
                                <td>{{ $history->payment_status }}</td>
                                <td>{{ $history->payment_bank }}</td>
                                <td>{{ $history->request_id }}</td>
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
