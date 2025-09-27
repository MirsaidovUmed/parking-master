@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="rounded p-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">{{__('Изменить Тариф')}}</h6>
                <form method="post" action="{{ url('subscription/update/' . $getSubscription->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Название подписка</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{$getSubscription->name}}" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Сумма</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cost"
                                   value="{{$getSubscription->cost}}" required/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Обнавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
