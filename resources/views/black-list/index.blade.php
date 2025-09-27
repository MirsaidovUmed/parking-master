@extends('layouts.app')
@section('title-page')
    Статистика
@endsection
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4 d-flex justify-content-between align-items-center">
                        Черный список
                        <!-- Кнопка открытия -->
                        <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#addBlacklistModal">
                            Добавить
                        </button>
                    </h6>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th scope="col">Гос.номер</th>
                                <th scope="col">Причина</th>
                                <th scope="col">Въезд</th>
                                <th scope="col">Выезд</th>
                                <th scope="col">Дата создания</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($getBlackList as $item)
                                <tr>
                                    <td>{{ $item->plate_number }}</td>
                                    <td>{{ $item->reason }}</td>
                                    <td>
                                        @if($item->direction_in) ✅ @else ❌ @endif
                                    </td>
                                    <td>
                                        @if($item->direction_out) ✅ @else ❌ @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        <!-- Кнопка редактирования -->
                                        <button class="btn btn-sm btn-warning" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editBlacklistModal{{ $item->id }}">
                                            ✏️
                                        </button>

                                        <!-- Кнопка удаления -->
                                        <form action="{{ route('blacklist.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить этот номер?')">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal редактирования -->
                                <div class="modal fade" id="editBlacklistModal{{ $item->id }}" tabindex="-1" aria-labelledby="editBlacklistModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark text-light border-0 shadow-lg">
                                            <div class="modal-header border-secondary">
                                                <h5 class="modal-title" id="editBlacklistModalLabel{{ $item->id }}">Редактировать запись</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                            </div>
                                            <form action="{{ route('blacklist.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="plate_number_{{ $item->id }}" class="form-label">Гос.номер</label>
                                                        <input type="text" class="form-control bg-secondary text-light border-0" id="plate_number_{{ $item->id }}" name="plate_number" value="{{ $item->plate_number }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="reason_{{ $item->id }}" class="form-label">Причина</label>
                                                        <textarea class="form-control bg-secondary text-light border-0" id="reason_{{ $item->id }}" name="reason" rows="2">{{ $item->reason }}</textarea>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="direction_in_{{ $item->id }}" name="direction_in" value="1" {{ $item->direction_in ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="direction_in_{{ $item->id }}">Запретить въезд</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="direction_out_{{ $item->id }}" name="direction_out" value="1" {{ $item->direction_out ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="direction_out_{{ $item->id }}">Запретить выезд</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-secondary">
                                                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-warning">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-left">
                            {{ $getBlackList->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal добавления -->
    <div class="modal fade" id="addBlacklistModal" tabindex="-1" aria-labelledby="addBlacklistModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light border-0 shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="addBlacklistModalLabel">Добавить в черный список</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form action="{{ route('blacklist.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="plate_number" class="form-label">Гос.номер</label>
                            <input type="text" class="form-control bg-secondary text-light border-0" id="plate_number" name="plate_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Причина</label>
                            <textarea class="form-control bg-secondary text-light border-0" id="reason" name="reason" rows="2"></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="direction_in" name="direction_in" value="1" {{ $item->direction_in ? 'checked' : '' }}>
                            <label class="form-check-label" for="direction_in">Запретить въезд</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="direction_out" name="direction_out" value="1" {{ $item->direction_out ? 'checked' : '' }}>
                            <label class="form-check-label" for="direction_out">Запретить выезд</label>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
