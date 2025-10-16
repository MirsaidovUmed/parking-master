@extends('layouts.app')

@section('title-page')
    Лайв-управление шлагбаумом
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12 col-xl-6 offset-xl-3">
            <div class="bg-secondary rounded h-100 p-4 text-center">
                <h5 class="mb-4">Шлагбаум #{{ $barrier->id }} (порт {{ $barrier->barrierport }})</h5>
                <p class="mb-3">Текущий режим: <strong>{{ $barrier->mode }}</strong>, статус: <strong>{{ $barrier->status }}</strong></p>

                <div class="d-flex justify-content-center gap-3 mb-4">
                    <form method="POST" action="{{ route('barriers.live.open', $barrier->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">Открыть</button>
                    </form>
                    <form method="POST" action="{{ route('barriers.live.close', $barrier->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg">Закрыть</button>
                    </form>
                </div>

                <form method="POST" action="{{ route('barriers.live.exit', $barrier->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Выйти из лайв-режима</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


