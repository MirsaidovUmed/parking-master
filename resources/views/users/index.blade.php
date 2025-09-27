@extends('layouts.app')
@section('title-page')
    Пользователи
@endsection

@section('subtitle')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded pb-0 p-4 mb-3">
            <div class="cl-2">
                <ul class="navbar-main-submenu">
                    @can('Просмотр пользователей')
                        <a href="{{ url('users/index') }}" class="user-hover" style="color: var(--bs-light)">
                            @php
                                $linkActive1 = ['users*'];
                            @endphp
                            <li class="align-items-center {{ request()->is($linkActive1) ? 'text-danger' : '' }}" style="padding: 15px 15px; border-bottom: 1px solid;">
                                Пользователи
                            </li>
                        </a>
                    @endcan
                    @can('Просмот ролей')
                        <a href="{{ url('roles/index') }}" class="role-hover" style="color: var(--bs-light)">
                            <li class="align-content-center" style="padding: 15px 15px; border-bottom: 1px solid">
                                Роли
                            </li>
                        </a>
                    @endcan
                    @can('Просмотр доступы')
                        <a href="{{ url('accesses/index') }}" class="role-hover" style="color: var(--bs-light)">
                            <li class="align-content-center" style="padding: 15px 15px; border-bottom: 1px solid">
                                Доступы
                            </li>
                        </a>
                    @endcan
                    @can('Добавить пользователя')
                        <li style="display: flex; justify-content: flex-end; width: 90%;">
                            <button type="button" class="btn btn-primary float-start p-sm-3 border-0"
                                    data-bs-toggle="modal" data-bs-target="#storePriceModal">
                                Добавить пользователя
                            </button>
                        </li>
                    @endcan
                </ul>
                <!-- Модальное окно -->
                <div class="modal fade" id="storePriceModal" tabindex="-1" aria-labelledby="storePriceModal"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-5">
                            <h5 class="modal-title pb-4" id="storePriceModalLabel">Добавить</h5>
                            <form method="post" action="{{ url('users/store') }}" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" placeholder="Имя пользователя" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Имя пользователя</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('login') is-invalid @enderror"
                                           name="username" id="login" placeholder="Логин используется для вход" required>
                                    @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Логин для входа в ЛК</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           id="email" placeholder="email" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" placeholder="Пароль" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label>Пароль</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <p style="float: left">Выберите роли</p>
                                    <select class="form-select" name="roles" id="rolesSelect"
                                            aria-label="Default select example">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-grid mt-0">
                                    <input type="submit" name="send" value="Добавить"
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
        <div class="bg-secondary text-center rounded pt-0 p-4">
            <div class="table-responsive">
                <table class="table text-start align-middle mb-0" id="info-table">
                    <thead style="color: #718096;">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Роли</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($users))
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->username}}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $role)
                                            <span>{{ $role }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('users/edit/'. $user->id) }}" class="btn">
                                        <i class="fa"><img src="{{ asset('images/edit.svg') }}" alt="editor"></i>
                                    </a>
                                    <form method="POST" action="{{ url('users/delete/' . $user->id) }}"
                                          style="display: inline-block">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn"><i class="fa"><img
                                                    src="{{ asset('images/delete.svg') }}"
                                                    alt="deleted"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-left">
                    {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
