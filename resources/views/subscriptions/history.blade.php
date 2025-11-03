@extends('layouts.app')
@section('title-page')
    Подписки
@endsection

@section('subtitle')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded pb-0 p-4 mb-3">
            <div class="cl-2">
                <ul class="navbar-main-submenu">
                    <li class="align-items-center text-danger" style="padding: 15px 15px;">
                        <h4><a href="{{url('subscription/history')}}">История подписок</a></h4>
                    </li>
                    <li>
                        <div class="search">
                            <form class="d-none d-md-flex" action="{{url('subscription/history')}}">
                                <input type="hidden" name="action" value="search">
                                <i class="fa" style="position: absolute;margin: 17px;"><img
                                        src="{{ asset('images/search-normal.svg') }}" alt="search-logo"></i>
                                <input class="form-control bg-white border-0 p-3 ps-5" type="search" name="plate"
                                       id="search-text" onkeyup="tableSearch()" placeholder="Посик по номер ТС..."
                                       style="border: 1px solid #E2E8F0 !important; margin-right: 5px">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                            </form>
                        </div>
                    </li>
                </ul>
                <!-- Модальное окно -->
                <div class="modal fade" id="storePriceModal" tabindex="-1" aria-labelledby="storePriceModal"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-5">
                            <h5 class="modal-title pb-4" id="storePriceModalLabel">Создание тариф</h5>
                            <form method="post" action="{{ route('tariff.store') }}" enctype="multipart/form-data"
                                  novalidate>
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" placeholder="Название тариф" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Название тариф</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="minutes" placeholder="email" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Сумма</label>
                                </div>
                                <div class="d-grid mt-0">
                                    <input type="submit" name="send" value="Создать"
                                           class="btn btn-primary py-3 w-100 mb-1">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end modal window-->
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid pt-0 px-4 mb-auto">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-secondary text-center rounded pt-0 p-4">
            <div class="table-responsive">
                <table class="table text-start align-middle mb-0" id="info-table">
                    <thead style="color: #718096;">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Гос.номер</th>
                        <th scope="col">Начало</th>
                        <th scope="col">Конец</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Подписка</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($listHistory))
                        @foreach($listHistory as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->plate_number}}</td>
                                <td>{{$item->started_at}}</td>
                                <td>{{$item->ended_at}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->subscription->name ?? '-'}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-left">
                    {{ $listHistory->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
