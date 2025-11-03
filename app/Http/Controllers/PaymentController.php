<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use App\Models\VehicleEvent;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр платежей', ['only' => ['index']]);
    }

    public function index()
    {
        $payments = VehicleEvent::latest('id')->paginate(10);
        foreach ($payments as $payment) {
            $payment->cost = CurrencyHelper::toSomoni($payment->cost);
        }
        return view('payments.index', compact('payments'));
    }
}
