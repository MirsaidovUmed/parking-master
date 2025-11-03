@extends('layouts.app')
@section('title-page')
    Тарифы
@endsection

@section('subtitle')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded pb-0 p-4 mb-3">
        <div class="cl-2">
            <ul class="navbar-main-submenu">
                <li class="align-items-center text-danger" style="padding: 15px 15px;">
                    <h4>Тарифы</h4>
                </li>
                @can('Создание тариф')
                <li style="display: flex; justify-content: flex-end; width: 100%; gap:10px;">
                    <button type="button" class="btn btn-primary float-start p-sm-3 border-0"
                            data-bs-toggle="modal" data-bs-target="#createTariffModal">
                        Создать тариф
                    </button>
                    <button type="button" class="btn btn-success float-start p-sm-3 border-0"
                            data-bs-toggle="modal" data-bs-target="#createTariffExtendedModal">
                        Создать тариф (расширенный)
                    </button>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>

<!-- 🔹 1-я модалка — обычный тариф -->
<div class="modal fade" id="createTariffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5">
            <h5 class="modal-title pb-4">Создание тарифа</h5>
            <form id="firstStepForm">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tariffName" placeholder="Название" required>
                    <label>Название тарифа</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stepsCount" min="1" max="10" placeholder="Количество шагов" required>
                    <label>Количество шагов</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stepTime" min="1" placeholder="Время шага (минут)" required>
                    <label>Время шага (минут)</label>
                </div>

                <div class="d-grid">
                    <button type="button" id="nextToSteps" class="btn btn-primary">Далее</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 2-я модалка — настройка шагов обычного тарифа -->
<div class="modal fade" id="stepsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-5">
            <h5 class="modal-title pb-4">Настройка шагов тарифа</h5>
            <form method="POST" action="{{ route('tariff.store') }}">
                @csrf
                <input type="hidden" name="name" id="finalName">
                <input type="hidden" name="steps" id="finalSteps">
                <input type="hidden" name="stepTime" id="finalStepTime">

                <div id="stepsContainer" class="mb-3"></div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Создать тариф</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 1-я модалка расширенного тарифа -->
<div class="modal fade" id="createTariffExtendedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5">
            <h5 class="modal-title pb-4">Создание расширенного тарифа</h5>
            <form id="firstStepFormExtended">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tariffNameExtended" placeholder="Название" required>
                    <label>Название тарифа</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stepsCountExtended" min="1" max="10" placeholder="Количество шагов" required>
                    <label>Количество шагов</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="stepTimeExtended" min="1" placeholder="Время шага (минут)" required>
                    <label>Время шага (минут)</label>
                </div>

                <div class="d-grid">
                    <button type="button" id="nextToStepsExtended" class="btn btn-success">Далее</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🔹 2-я модалка — расширенного тарифа -->
<div class="modal fade" id="stepsModalExtended" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-5">
            <h5 class="modal-title pb-4">Настройка шагов расширенного тарифа</h5>
            <form method="POST" action="{{ route('tariff.store') }}">
                @csrf
                <input type="hidden" name="is_extended" value="1">
                <input type="hidden" name="name" id="finalNameExtended">
                <input type="hidden" name="steps" id="finalStepsExtended">
                <input type="hidden" name="stepTime" id="finalStepTimeExtended">

                <div id="stepsContainerExtended" class="mb-3"></div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="enableCoefficientExtended">
                    <label class="form-check-label" for="enableCoefficientExtended">
                        Записать коэффициент
                    </label>
                </div>

                <div id="coefficientFieldsExtended" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" name="coefficient" placeholder="Коэффициент">
                                <label>Коэффициент</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="minute" placeholder="Минуты">
                                <label>Минуты</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Создать тариф (расширенный)</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid pt-0 px-4 mb-auto">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-secondary text-center rounded pt-0 p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle mb-0" id="info-table">
                <thead style="color: #718096;">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Название тарифа</th>
                        <th scope="col">Интервал (мин)</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grouped = $listTarif->groupBy('name');
                        $counter = 1;
                    @endphp
                    @foreach($grouped as $name => $tariffs)
                        @foreach($tariffs as $item)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->step_start }} - {{ $item->step_end }} мин</td>
                            <td>{{ $item->price_display }} сом</td>
                            <td>{{ $item->is_active ? 'Активный' : 'Неактивный' }}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                @can('Изменить тариф')
                                <a href="{{ url('tariff/edit/' . $item->id) }}" class="btn">
                                    <img src="{{ asset('images/edit.svg') }}" alt="edit">
                                </a>
                                @endcan
                                @can('Удалить тариф')
                                <form method="POST" action="{{ url('tariff/delete/' . $item->id) }}" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn">
                                        <img src="{{ asset('images/delete.svg') }}" alt="delete">
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-left">
                {{ $listTarif->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Обычный тариф
    const btnNext = document.getElementById('nextToSteps');
    if (btnNext) {
        btnNext.addEventListener('click', function () {
            const name = document.getElementById('tariffName').value;
            const steps = parseInt(document.getElementById('stepsCount').value);
            const stepTime = parseInt(document.getElementById('stepTime').value);

            if (!name || !steps || !stepTime) {
                alert('Пожалуйста, заполните все поля');
                return;
            }

            document.getElementById('finalName').value = name;
            document.getElementById('finalSteps').value = steps;
            document.getElementById('finalStepTime').value = stepTime;

            let container = document.getElementById('stepsContainer');
            container.innerHTML = '';
            let start = 0;

            for (let i = 0; i < steps; i++) {
                let end = start + stepTime;
                container.innerHTML += `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="${start} - ${end} мин" readonly>
                                <label>Интервал ${i+1}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="price_per_steps[]" placeholder="Цена за интервал" required>
                                <label>Цена (сом)</label>
                            </div>
                        </div>
                    </div>
                `;
                start = end;
            }

            bootstrap.Modal.getInstance(document.getElementById('createTariffModal')).hide();
            new bootstrap.Modal(document.getElementById('stepsModal')).show();
        });
    }

    // Расширенный тариф
    const btnNextExtended = document.getElementById('nextToStepsExtended');
    if (btnNextExtended) {
        btnNextExtended.addEventListener('click', function () {
            const name = document.getElementById('tariffNameExtended').value;
            const steps = parseInt(document.getElementById('stepsCountExtended').value);
            const stepTime = parseInt(document.getElementById('stepTimeExtended').value);

            if (!name || !steps || !stepTime) {
                alert('Пожалуйста, заполните все поля');
                return;
            }

            document.getElementById('finalNameExtended').value = name;
            document.getElementById('finalStepsExtended').value = steps;
            document.getElementById('finalStepTimeExtended').value = stepTime;

            let container = document.getElementById('stepsContainerExtended');
            container.innerHTML = '';
            let start = 0;

            for (let i = 0; i < steps; i++) {
                let end = start + stepTime;
                container.innerHTML += `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="${start} - ${end} мин" readonly>
                                <label>Интервал ${i+1}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="price_per_steps[]" placeholder="Цена за интервал" required>
                                <label>Цена (сом)</label>
                            </div>
                        </div>
                    </div>
                `;
                start = end;
            }

            bootstrap.Modal.getInstance(document.getElementById('createTariffExtendedModal')).hide();
            new bootstrap.Modal(document.getElementById('stepsModalExtended')).show();
        });
    }

    // Чекбокс коэффициента для расширенного тарифа
    const checkboxCoefficient = document.getElementById('enableCoefficientExtended');
    if (checkboxCoefficient) {
        checkboxCoefficient.addEventListener('change', function () {
            document.getElementById('coefficientFieldsExtended').style.display = this.checked ? 'block' : 'none';
        });
    }
});
</script>
@endpush
