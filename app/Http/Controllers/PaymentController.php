<?php

namespace App\Http\Controllers;

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
        $payments = VehicleEvent::latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }
}
