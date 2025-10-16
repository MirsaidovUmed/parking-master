<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SistemSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware("Просмотр настроек", ["only"=> ["index"]]);
    }
}
