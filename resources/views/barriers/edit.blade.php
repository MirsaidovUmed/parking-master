@extends('layouts.app')

@section('title-page')
    Редактирование шлагбаума
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12 col-xl-8 offset-xl-2">
            <div class="bg-secondary rounded h-100 p-4">
                <h5 class="mb-4">Редактирование</h5>
                <form action="{{ route('barriers.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Порт</label>
                        <input type="number" class="form-control" value="{{ $item->barrierport }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Направление</label>
                        <input type="text" class="form-control" value="{{ $item->direction }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Режим</label>
                        <select name="mode" class="form-select">
                            <option value="auto" {{ old('mode', $item->mode) == 'auto' ? 'selected' : '' }}>auto</option>
                            <option value="manual" {{ old('mode', $item->mode) == 'manual' ? 'selected' : '' }}>manual</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Статус</label>
                        <select name="status" class="form-select">
                            <option value="none" {{ old('status', $item->status) == 'none' ? 'selected' : '' }}>none</option>
                            <option value="opened" {{ old('status', $item->status) == 'opened' ? 'selected' : '' }}>opened</option>
                            <option value="closed" {{ old('status', $item->status) == 'closed' ? 'selected' : '' }}>closed</option>
                        </select>
                        <div class="form-text">Выбор opened/closed переключит режим на manual и отправит команду устройству. В режиме auto статус будет none.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


