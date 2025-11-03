@extends('layouts.app')

@section('title-page')
    Шлагбаумы
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Список шлагбаумов</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarrierModal">Добавить</button>
        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                <tr class="text-white">
                    <th>#</th>
                    <th>№</th>
                    <th>Имя</th>
                    <th>Режим</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            <input type="checkbox" class="row-check" value="{{ $item->id }}" />
                        </td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->mode === 'manual' ? 'ручной' : 'авто' }}</td>
                        <td>{{ $item->status === 'none' ? 'авто' : (($item->status === 'closed' ? 'закрыт' : 'открыт')) }}</td>
                        <td>
                            <a href="{{ route('barriers.edit', $item->id) }}" class="btn btn-sm btn-warning">Изменить</a>
                            <form action="{{ route('barriers.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex gap-2">
            <form id="bulkOpenForm" method="POST" action="{{ route('barriers.bulk') }}">
                @csrf
                <input type="hidden" name="action" value="open">
                <input type="hidden" name="ids" id="bulkIdsOpen" />
                <button type="button" class="btn btn-success" onclick="submitBulk('open')">Открыть выбранные</button>
            </form>
            <form id="bulkCloseForm" method="POST" action="{{ route('barriers.bulk') }}">
                @csrf
                <input type="hidden" name="action" value="close">
                <input type="hidden" name="ids" id="bulkIdsClose" />
                <button type="button" class="btn btn-danger" onclick="submitBulk('close')">Закрыть выбранные</button>
            </form>
            <form id="bulkAutoForm" method="POST" action="{{ route('barriers.bulk') }}">
                @csrf
                <input type="hidden" name="action" value="auto">
                <input type="hidden" name="ids" id="bulkIdsAuto" />
                <button type="button" class="btn btn-warning" onclick="submitBulk('auto')">Автоматический режим</button>
            </form>

            <form id="enterLiveForm" method="POST" action="{{ route('barriers.live.enter') }}">
                @csrf
                <input type="hidden" name="id" id="liveId" />
                <button type="button" class="btn btn-outline-info" onclick="enterLive()">Лайв-режим</button>
            </form>
        </div>

        <script>
            function collectSelected() {
                return Array.from(document.querySelectorAll('.row-check:checked')).map(cb => cb.value).join(',');
            }
            function submitBulk(action) {
                const ids = collectSelected();
                if (!ids) { alert('Выберите хотя бы один шлагбаум'); return; }
                if (action === 'open') {
                    document.getElementById('bulkIdsOpen').value = ids;
                    document.getElementById('bulkOpenForm').submit();
                } else if (action === 'close') {
                    document.getElementById('bulkIdsClose').value = ids;
                    document.getElementById('bulkCloseForm').submit();
                } else {
                    document.getElementById('bulkIdsAuto').value = ids;
                    document.getElementById('bulkAutoForm').submit();
		}
            }
            function enterLive() {
                const ids = collectSelected();
                if (!ids || ids.split(',').length !== 1) { alert('Выберите один шлагбаум для лайв-режима'); return; }
                document.getElementById('liveId').value = ids;
                document.getElementById('enterLiveForm').submit();
            }
        </script>

        <div class="mt-3">
            {{ $items->links() }}
        </div>
    </div>
</div>

<!-- Модалка создания -->
<div class="modal fade" id="createBarrierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5">
            <h5 class="modal-title pb-4">Создать шлагбаум</h5>
            <form method="POST" action="{{ route('barriers.store') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Имя (необязательно)">
                    <label>Имя (необязательно)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" min="1" max="65535" class="form-control" name="barrierport" id="barrierport" placeholder="Порт" required>
                    <label>Порт</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="direction" id="direction" required>
                        <option value="in">in</option>
                        <option value="out">out</option>
                    </select>
                    <label>Направление</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Создать</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection


