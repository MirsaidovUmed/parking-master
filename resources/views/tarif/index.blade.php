@extends('layouts.app')
@section('title-page')
    Тарифы
@endsection

@section('subtitle')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded pb-0 p-4 mb-3">
            <div class="cl-2">
                <ul class="navbar-main-submenu">
                    <li class="align-items-center text-danger" style="padding: 15px 15px;">
                        <h4>Тарифы</h4>
                    </li>
                    @can('Создание тариф')
                        <li style="display: flex; justify-content: flex-end; width: 100%;">
                            <button type="button" class="btn btn-primary float-start p-sm-3 border-0"
                                    data-bs-toggle="modal" data-bs-target="#storePriceModal">
                                Создать тариф
                            </button>
                        </li>
                    @endcan
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
                        <th scope="col">Название</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата создание</th>
                        @canany(['Изменить тариф', 'Удалить тариф'])
                            <th scope="col">Действия</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($listTarif))
                        @foreach($listTarif as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price_per_minute}}</td>
                                <td>{{$item->is_active==1?'активный' : 'не активный'}}</td>
                                <td>{{$item->created_at}}</td>

                                <td>
                                    @can('Изменить тариф')
                                        <a href="{{ url('tariff/edit/'. $item->id) }}" class="btn">
                                            <i class="fa"><img src="{{ asset('images/edit.svg') }}" alt="editor"></i>
                                        </a>
                                    @endcan

                                    @can('Удалить тариф')
                                        <form method="POST" action="{{ url('tariff/delete/' . $item->id) }}"
                                              style="display: inline-block">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn"><i class="fa"><img
                                                        src="{{ asset('images/delete.svg') }}"
                                                        alt="deleted"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-left">
                    {{ $listTarif->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
