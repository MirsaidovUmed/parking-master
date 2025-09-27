@extends('layouts.app')
@section('title-page', 'Платежи')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 d-flex justify-content-between align-items-center">
                    Платежи
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
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->plate_number }}</td>
                                <td>{{ $payment->payment_amount }}</td>
                                <td>{{ $payment->payment_status }}</td>
                                <td>{{ $payment->payment_bank }}</td>
                                <td>{{ $payment->request_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-left">
                        {{ $payments->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
