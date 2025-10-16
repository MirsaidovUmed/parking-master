<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use App\Models\VehicleEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Главная страница', ['only' => ['index']]);
    }

    public function index()
    {

        $today = Carbon::now('Asia/Dushanbe')->toDateString(); 

        $zaezdCountCurrDay = VehicleEvent::whereDate('status_in_time', $today)->count();
        $zaezdCountMonth   = VehicleEvent::whereMonth('status_in_time', Carbon::now('Asia/Dushanbe')->month)->count();
        $sumCurrDay        = VehicleEvent::whereDate('status_in_time', $today)->sum('payment_amount');
        $sumMonth          = VehicleEvent::whereMonth('status_in_time', Carbon::now('Asia/Dushanbe')->month)->sum('payment_amount');

        $sumCurrDayDisplay = CurrencyHelper::toSomoni($sumCurrDay);
        $sumMonthDisplay   = CurrencyHelper::toSomoni($sumMonth);

        // последние 5 машин
        $lastCars = VehicleEvent::latest()->take(5)->get();

         $lastCars->each(function ($car) {
            $car->payment_display = CurrencyHelper::toSomoni($car->payment_amount);
        });

        return view('home', compact(
            'zaezdCountCurrDay',
            'zaezdCountMonth',
            'sumCurrDayDisplay',
            'sumMonthDisplay',
            'lastCars'
        ));
    }

}
