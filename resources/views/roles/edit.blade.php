@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-5">
        <div class="bg-secondary rounded p-4">
            <h6 class="mb-4">{{__('Изменить роль')}}</h6>
            <form method="post" action="{{ url('roles/update/'. $role->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Название роль</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}" required/>
                    </div>
                </div>
                <div class="row mb-3">
                    <strong>Доступы:</strong>
                    @foreach($permissions as $value)
                        <div class="form-check">
                            @if(in_array($value->id, $role_permissions))
                                <input class="form-check-input" type="checkbox" value="{{ $value->id }}" name="permissions[]"
                                       id="flexCheckChecked{{$value->id}}" checked>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $value->id }}"
                                       name="permissions[]" id="flexCheckChecked{{$value->id}}">
                            @endif
                            <label class="form-check-label" for="flexCheckChecked{{$value->id}}">
                                {{ $value->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Обнавить</button>
            </form>
        </div>
    </div>
@endsection
