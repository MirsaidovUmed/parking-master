@extends('layouts.app')
@section('title-page')
    Пользователи
@endsection
@section('subtitle')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded pb-0 p-4">
            <div class="cl-2">
                <ul class="navbar-main-submenu">
                    @can('Просмотр пользователей')
                        <a href="{{ url('users/index') }}" class="user-hover" style="color: var(--bs-light)">
                            <li class="align-items-center" style="padding: 15px 15px; border-bottom: 1px solid">
                                Пользователи
                            </li>
                        </a>
                    @endcan
                    @can('Просмот ролей')
                            @php
                                $linkActive1 = ['roles*'];
                            @endphp
                        <a href="{{ url('roles/index') }}" class="role-hover " style="color: var(--bs-light)">
                            <li class="align-content-center {{ request()->is($linkActive1) ? 'text-danger' : '' }}" style="padding: 15px 15px; border-bottom: 1px solid">
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
                    @can('Добавить роль')
                        <li style="display: flex; justify-content: flex-end; width: 90%;">
                            <a href="{{ url('roles/create') }}">
                                <button type="button" class="btn btn-primary float-start p-sm-3 border-0">
                                    Добавить роль
                                </button>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid mt-2 pt-0 px-4">
        <div class="bg-secondary text-center rounded p-4 pt-0">
            <div class="table-responsive">
                <table class="table text-start align-middle">
                    <thead style="color: #718096;">
                    <tr>
                        <th>Название рол</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ url('/roles/edit/' . $role->id) }}" data-toggle="modal"
                                   data-bs-target="#roleModal">
                                    <i class="fa"><img src="{{ asset('images/edit.svg') }}" alt="editor"></i>
                                </a>
                                <form method="POST" action="{{ url('/roles/delete/' . $role->id) }}"
                                      style="display: inline-block">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn"><i class="fa"><img
                                                src="{{ asset('images/delete.svg') }}" alt="deleted"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                <div class="d-flex justify-content-left">
                    {{ $roles->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
