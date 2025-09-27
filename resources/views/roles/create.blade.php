@extends('layouts.app')
@section('title-page')
    Добавить Рол
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded pt-2 p-4">
            <div class="table-responsive">
                <form method="post" action="{{ url('roles/store') }}" novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" id="name" placeholder="Название роль" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <label>Названия роль</label>
                    </div>
                    <table class="table text-start align-middle">
                        <thead style="color: #718096;">
                        <tr>
                            <th class="p-3">Доступ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permission as $value)
                            <tr>
                                <td>
                                    <div class="form-floating p-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $value->id }}"
                                                   id="flexCheckChecked{{$value->id}}" name="permissions[]"
                                                   required>
                                            <label class="form-check-label" for="flexCheckChecked{{$value->id}}">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-floating mb-3 d-flex justify-content-between">
                        <div class="d-grid mt-3" style="width: 49%">
                            <a href="{{ url('roles/index') }}" class="btn --secondary py-3 w-100 mb-1" style=" border: 1px solid #E2E8F0">Отмена</a>
                        </div>
                        <div class="d-grid mt-3" style="width: 49%">
                            <input type="submit" name="send" value="Добавить" class="btn btn-primary py-3 w-100 mb-1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
