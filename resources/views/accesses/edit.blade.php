@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="rounded p-4">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">{{__('Изменить название доступа')}}</h6>
                <form method="post" action="{{ url('accesses/update/' . $access->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Название Доступ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $access->name }}" readonly/>
                        </div>
                    </div>
                    <div class="row mb-3" style="display: flex;flex-wrap: nowrap;">
                        <label class="col-sm-2 col-form-label">Категория</label>
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="text" class="form-control" name="category" value="{{ $access->category }}" required/>--}}
{{--                        </div>--}}
                        <select class="form-select" name="category" style="width: 50%;">
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category }}"
                                        @if(isset($category) && $category->category == $access->category) selected @endif>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
