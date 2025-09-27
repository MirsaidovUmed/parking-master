<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Главная страница', ['only' => ['index']]);
    }

    public function index()
    {
        return view('home');
    }
}
