<?php

namespace App\Http\Controllers;

use App\Models\Statistic;

class StatisticController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр статистики', ['only' => ['index']]);
    }

    public function index()
    {
        $query = Statistic::query();

        // Фильтры по времени
        $startOfDay = now()->startOfDay();
        $endOfDay = now()->endOfDay();

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // === Дневная статистика ===
        $avgMinCurrDay = (clone $query)
            ->whereBetween('status_in_time', [$startOfDay, $endOfDay])
            ->selectRaw('AVG(p5::numeric) as avg_p5')
            ->value('avg_p5');

        $zaezdCountCurrDay = (clone $query)
            ->whereBetween('status_in_time', [$startOfDay, $endOfDay])
            ->count();

        // === Месячная статистика ===
        $avgMinMonth = (clone $query)
            ->whereBetween('status_in_time', [$startOfMonth, $endOfMonth])
            ->selectRaw('AVG(p5::numeric) as avg_p5')
            ->value('avg_p5');

        $zaezdCountMonth = (clone $query)
            ->whereBetween('status_in_time', [$startOfMonth, $endOfMonth])
            ->count();

        // === Топ 10 записей ===
        $eventTopVehiclesGet = (clone $query)
            ->orderByDesc('status_in_time')
            ->limit(10)
            ->get();

        return view('statistics.index', compact(
            'eventTopVehiclesGet',
            'avgMinCurrDay',
            'zaezdCountCurrDay',
            'avgMinMonth',
            'zaezdCountMonth'
        ));
    }
}
