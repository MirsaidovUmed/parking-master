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
                        <h4>Подписки</h4>
                    </li>
                    @can('История подписок')
                        <li style="display: flex; justify-content: flex-end; width: 80%;">
                            <a href="{{route('subscription.history')}}" style="margin-top: 10px">
                                <button type="button" class="btn btn-info float-start p-sm-4 border-0">
                                    История подписок
                                </button>
                            </a>
                        </li>
                    @endcan
                    @can('Добавить подписку')
                        <li style="display: flex; justify-content: flex-end; width: 25%;">
                            <button type="button" class="btn btn-primary float-start p-sm-1 border-0"
                                    data-bs-toggle="modal" data-bs-target="#storePriceModal">
                                Создать подписку
                            </button>
                        </li>
                    @endcan
                </ul>
                <!-- Модальное окно -->
                <div class="modal fade" id="storePriceModal" tabindex="-1" aria-labelledby="storePriceModal"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-5">
                            <h5 class="modal-title pb-4" id="storePriceModalLabel">Создание подписки</h5>
                            <form method="post" action="{{ route('subscription.store') }}" enctype="multipart/form-data"
                                  novalidate>
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" placeholder="Название подписки" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Название подписки</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                           name="cost" placeholder="email" required>
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
                        @canany(['Изменить подписку', 'Удалить подписку'])
                            <th scope="col">Действия</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($subscriptions))
                        @foreach($subscriptions as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->cost}}</td>
                                <td>
                                    @can('Изменить подписку')
                                        <a href="{{ url('subscription/edit/'. $item->id) }}" class="btn">
                                            <i class="fa"><img src="{{ asset('images/edit.svg') }}" alt="editor"></i>
                                        </a>
                                    @endcan

                                    @can('Удалить подписку')
                                        <form method="POST" action="{{ route('subscription.delete', $item->id) }}" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn">
                                                <i class="fa"><img src="{{ asset('images/delete.svg') }}" alt="deleted"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-left">
                    {{ $subscriptions->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
