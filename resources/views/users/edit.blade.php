@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="rounded p-4">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">{{__('Изменить пользователя')}}</h6>
                <form method="post" action="{{ url('users/update/' . $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Логин для входа в ЛК</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" value="" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Рол</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="role_id">
                                <option value="">Выберите роль</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                            @if(isset($user) && $user->roles->contains('id', $role->id)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if(!empty($permissions))
                        <div class="form-floating mb-4 d-inline-block">
                            <br style="float: left">Выберите дополнительное разрешения для этой пользователь<br>
                            @foreach($permissions as $permission)
                                <div class="form-check d-block">
                                    @if(in_array($permission->id, $user_permissions))
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permissions[]"
                                               id="flexCheckChecked{{$permission->id}}" checked>
                                    @else
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                               name="permissions[]" id="flexCheckChecked{{$permission->id}}">
                                    @endif
                                    <label class="form-check-label" for="flexCheckChecked{{$permission->id}}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Обнавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
