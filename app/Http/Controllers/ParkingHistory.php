<?php

namespace App\Http\Controllers;

use App\Models\VehicleEvent;
use Illuminate\Http\Request;

class ParkingHistory extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:Просмотр истории парковок", ["only"=> ["index"]]);
    }

    public function index()
    {
        $parkingHistory = VehicleEvent::latest()->paginate(10);
        return view('parking-history.index', compact('parkingHistory'));
    }
}
