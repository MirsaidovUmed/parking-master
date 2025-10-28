@extends('layouts.app')

@section('title-page')
    Зоны
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Список зон</h5>

                <!-- Кнопка открытия модального окна для создания -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createZoneModal">
                    <i class="fas fa-plus"></i> Добавить зону
                </button>
            </div>

            <!-- Таблица зон -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($zones as $zone)
                        <tr>
                            <td>{{ $zone->id }}</td>
                            <td>{{ $zone->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editZoneModal{{ $zone->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('zone.delete', $zone->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Удалить эту зону?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Модальное окно редактирования -->
                        <div class="modal fade" id="editZoneModal{{ $zone->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Редактировать зону</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('zone.update', $zone->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $zone->id }}" class="form-label">Название</label>
                                                <input type="text" name="name" id="name{{ $zone->id }}"
                                                       class="form-control" value="{{ $zone->name }}" required maxlength="64">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                            <button type="submit" class="btn btn-success">Сохранить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Нет доступных зон</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Пагинация -->
            <div class="d-flex justify-content-center mt-3">
                {{ $zones->links() }}
            </div>
        </div>
    </div>

    <!-- Модальное окно создания зоны -->
    <div class="modal fade" id="createZoneModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить новую зону</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('zone.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Введите название зоны" required maxlength="64">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
