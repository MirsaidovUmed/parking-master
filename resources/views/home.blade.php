@extends('layouts.app')
@section('title-page')
    Главная страница
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6" style="flex: 0 0 auto; width: 50%; margin: 20%;">
                <div class="bg-secondary rounded h-100 p-4">
                    <div class="card-header">{{ __('Главная') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Добро пожаловать в админ панел Parking!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
