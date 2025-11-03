<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TariffController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр тариф', ['only' => ['index']]);
        $this->middleware('permission:Создание тариф', ['only' => ['store']]);
        $this->middleware('permission:Изменить тариф', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить тариф', ['only' => ['destroy']]);
    }

    /**
     * Список тарифов (пагинация)
     */
    public function index()
    {
        $listTarif = Tariff::latest('id')->paginate(10);

        // Подготовим удобный формат для отображения шагов
        foreach ($listTarif as $tariff) {
            $tariff->parsed_steps = $this->parseStepsFromModel($tariff);

            $tariff->price_display = CurrencyHelper::toSomoni($tariff->price_per_step);
        }

        return view('tarif.index', compact('listTarif'));
    }

    /**
     * Сохранение нового тарифа — принимает:
     * name, steps (кол-во), stepTime (минуты),
     * поля p0..pN и price_per_step0..price_per_stepN (генерируются второй модалкой)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:64',
            'steps'            => 'required|integer|min:1|max:11',
            'stepTime'         => 'required|integer|min:1',
            'price_per_steps'  => 'required|array',
            'price_per_steps.*'=> 'required|integer|min:0',
            'is_extended'      => 'nullable|in:1',
            'coefficient'      => 'nullable|numeric|min:0',
            'minute'           => 'nullable|integer|min:0',
        ]);

        $baseName       = $validated['name'];
        $stepsCount     = (int) $validated['steps'];
        $stepTime       = (int) $validated['stepTime'];
        $price_per_steps = $validated['price_per_steps'];
        $isExtended     = isset($validated['is_extended']);
        
        $coefficientValue = $isExtended && isset($validated['coefficient']) ? $validated['coefficient'] : null;
        $minuteValue      = $isExtended && isset($validated['minute']) ? (int)$validated['minute'] : null;

        // 🔹 Учитываем и soft delete
        $existingNames = Tariff::withTrashed()
            ->where('name', 'LIKE', $baseName . '%')
            ->pluck('name')
            ->toArray();

        $iteration = 0;
        foreach ($existingNames as $name) {
            if (preg_match('/^' . preg_quote($baseName, '/') . '\s+\d+$/u', $name)) {
                $iteration = max($iteration, 1);
            }
            if (preg_match('/^' . preg_quote($baseName, '/') . '\s+(\d+)\.(\d+)$/u', $name, $m)) {
                $iteration = max($iteration, (int)$m[1]);
            }
        }
        if ($iteration > 0) {
            $iteration++;
        }

        $data = [];
        $start = 0;
        $lastStepEnd = $stepsCount * $stepTime;
        $lastPrice   = $price_per_steps[$stepsCount - 1];

        // если коэффициент не задан, считаем автоматически
        if ($coefficientValue === null) {
            $coefficientValue = $lastPrice > 0 ? $lastStepEnd / $lastPrice : 0;
        }

        // 🔹 Генерируем общий ключ для группы
        $generationKey = (string) Str::uuid();

        for ($i = 1; $i <= $stepsCount; $i++) {
            $end = $start + $stepTime;

            if ($iteration === 0) {
                $stepName = $baseName . " " . $i;
            } else {
                $stepName = $baseName . " " . $iteration . "." . $i;
            }

            $data[] = [
                'name'           => $stepName,
                'price_per_step' => CurrencyHelper::toDiram($price_per_steps[$i - 1]),
                'step_start'     => $start,
                'step_end'       => $end,
                'is_active'      => true,
                'coefficient'    => $coefficientValue,
                'minute'         => $minuteValue,
                'p10'            => $generationKey,
                'created_by'     => Auth::id() ?? 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];

            $start = $end;
        }

        Tariff::insert($data);

        return redirect()->back()->with('success', "Тарифы успешно созданы");
    }

    /**
     * Форма редактирования (вывод)
     */
    public function edit($id)
    {
        $tariff = Tariff::findOrFail($id);
        $tariff->parsed_steps = $this->parseStepsFromModel($tariff);
        $tariff->price_per_step = CurrencyHelper::toSomoni($tariff->price_per_step);

         for ($i = 0; $i <= 10; $i++) {
        if (!empty($tariff["p{$i}"])) {
                $step = json_decode($tariff["p{$i}"], true);
                if (isset($step['price_per_step'])) {
                    $step['price_per_step'] = CurrencyHelper::toSomoni($step['price_per_step']);
                }
                $tariff["p{$i}"] = json_encode($step, JSON_UNESCAPED_UNICODE);
            }
        }

        return view('tarif.edit', compact('tariff'));
    }

    /**
     * Обновление тарифа.
     * Поддерживает как простое обновление name/price_per_step/is_active,
     * так и обновление шагов, если пришли p{i}/price_per_step{i}/steps/stepTime.
     */
    public function update(Request $request, $id)
    {
        $tariff = Tariff::findOrFail($id);

        // базовая валидация
        $rules = [
            'name' => 'required|string|max:64',
            'is_active' => 'nullable|in:0,1',
            'coefficient' => 'nullable|numeric|min:0',
            'minute' => 'nullable|integer|min:0',
        ];

        $stepsCount = $request->input('steps');
        if ($stepsCount) {
            $rules['steps'] = 'required|integer|min:1|max:11';
            $rules['stepTime'] = 'required|integer|min:1';
            for ($i = 0; $i < $stepsCount; $i++) {
                $rules["p{$i}"] = 'required|string';
                $rules["price_per_step{$i}"] = 'required|numeric|min:0';
            }
        } else {
            $rules['price_per_step'] = 'required|numeric|min:0';
        }

        $validated = $request->validate($rules);

        $updateData = [
            'updated_by' => Auth::id() ?? 1,
            'updated_at' => now(),
        ];

        // Коэффициент и минута
        $coefficientValue = $validated['coefficient'] ?? null;
        $minuteValue      = $validated['minute'] ?? null;

        // если шагов нет (простой тариф)
        if (!$stepsCount) {
            $updateData['price_per_step'] = CurrencyHelper::toDiram($validated['price_per_step']);
            if ($request->has('is_active')) {
                $updateData['is_active'] = (int) $request->input('is_active');
            }
            if ($coefficientValue !== null) {
                $updateData['coefficient'] = $coefficientValue;
            }
            if ($minuteValue !== null) {
                $updateData['minute'] = $minuteValue;
            }
            $tariff->update(array_merge($updateData, ['name' => $validated['name']]));
        } else {
            $stepTime = (int) $validated['stepTime'];
            $totalEnd = 0;

            for ($i = 0; $i < $stepsCount; $i++) {
                $start = $i * $stepTime;
                $end   = ($i + 1) * $stepTime;

                $convertedPrice = CurrencyHelper::toDiram($validated["price_per_step{$i}"]);
                $stepPayload = [
                    'start' => $start,
                    'end'   => $end,
                    'time'  => $validated["p{$i}"],
                    'price_per_step' => $convertedPrice,
                ];

                $updateData["p{$i}"] = json_encode($stepPayload, JSON_UNESCAPED_UNICODE);
                $totalEnd = $end;
            }

            for ($j = $stepsCount; $j <= 10; $j++) {
                $updateData["p{$j}"] = null;
            }

            $updateData['step_start'] = 0;
            $updateData['step_end'] = $totalEnd;

            if ($request->has('is_active')) {
                $updateData['is_active'] = (int) $request->input('is_active');
            }

            $updateData['price_per_step'] = CurrencyHelper::toDiram($validated['price_per_step0']);

            if ($coefficientValue !== null) {
                $updateData['coefficient'] = $coefficientValue;
            }
            if ($minuteValue !== null) {
                $updateData['minute'] = $minuteValue;
            }

            $tariff->update(array_merge($updateData, ['name' => $validated['name']]));
        }

        // Обновляем всю группу, если есть p10
        $groupKey = $tariff->p10;
        if ($groupKey) {
            $allTariffs = Tariff::where('p10', $groupKey)->get();
            foreach ($allTariffs as $t) {
                $newName = $validated['name'] . '-' . $t->id;
                $groupUpdate = [
                    'name' => $newName,
                    'is_active' => $request->has('is_active') ? (int) $request->input('is_active') : $t->is_active,
                    'updated_by' => Auth::id() ?? 1,
                    'updated_at' => now(),
                ];
                if ($coefficientValue !== null) {
                    $groupUpdate['coefficient'] = $coefficientValue;
                }
                if ($minuteValue !== null) {
                    $groupUpdate['minute'] = $minuteValue;
                }
                $t->update($groupUpdate);
            }
        }

        return redirect()->route('tariff.index')
            ->with('success', 'Тарифы успешно обновлены');
    }

    /**
     * Удаление тарифа
     */
    public function destroy($id)
    {
        $tariff = Tariff::findOrFail($id);
        $groupKey = $tariff->p10;

        $deleteData = [
            'deleted_at' => now(),
            'deleted_by' => Auth::id() ?? 1,
        ];

        if ($groupKey) {
            Tariff::where('p10', $groupKey)->update($deleteData);
            Tariff::where('p10', $groupKey)->delete();
        } else {
            $tariff->update($deleteData);
            $tariff->delete();
        }

        return redirect()->back()->with('success', 'Тарифы успешно удалены');
    }

    /**
     * Вспомогательная функция: распарсить p0..p10 колонки в удобный массив
     */
    private function parseStepsFromModel(Tariff $tariff): array
    {
        $res = [];
        for ($i = 0; $i <= 10; $i++) {
            $key = "p{$i}";
            $raw = $tariff->{$key} ?? null;
            if (empty($raw)) {
                continue;
            }

            // если это JSON, распарсим
            $decoded = @json_decode($raw, true);
            if (is_array($decoded) && (isset($decoded['time']) || isset($decoded['price_per_step']))) {
                
                if (isset($decoded['price_per_step'])) {
                $decoded['price_per_step_display'] = CurrencyHelper::toSomoni($decoded['price_per_step']);
                }
                
                $res[] = [
                    'index' => $i,
                    'start' => $decoded['start'] ?? null,
                    'end'   => $decoded['end'] ?? null,
                    'time'  => $decoded['time'] ?? null,
                    'price_per_step' => isset($decoded['price_per_step']) ? (int)$decoded['price_per_step'] : null,
                ];
                continue;
            }

            // fallback: если raw — обычная строка "HH:MM - HH:MM"
            $res[] = [
                'index' => $i,
                'start' => null,
                'end'   => null,
                'time'  => $raw,
                'price_per_step' => null,
            ];
        }

        return $res;
    }
}
