<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TariffController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр тариф', ['only' => ['index']]);
        $this->middleware('permission:Создание тариф', ['only' => ['store']]);
        $this->middleware('permission:Изменить тариф', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить тариф', ['only' => ['destroy']]);
    }

    public function index()
    {
        $listTarif = Tariff::paginate(10);
        return view('tarif.index', compact('listTarif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64|unique:tariffs,name',
            'price_per_minute' => 'required|integer|min:0',
        ]);

        Tariff::create([
            'name' => $request->name,
            'price_per_minute' => $request->price_per_minute,
            'is_active' => true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Тариф успешно создан');
    }

    public function edit($id)
    {
        $tariff = Tariff::findOrFail($id);
        return view('tarif.edit', compact('tariff'));
    }

    public function update(Request $request, $id)
    {
        $tariff = Tariff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:64|unique:tariffs,name,' . $tariff->id,
            'price_per_minute' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $tariff->update([
            'name' => $request->name,
            'price_per_minute' => $request->price_per_minute,
            'is_active' => $request->is_active,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Тариф успешно обновлен');
    }

    public function destroy($id)
    {
        $tariff = Tariff::findOrFail($id);
        $tariff->update([
            'deleted_at' => Carbon::now(),
            'deleted_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Тариф успешно удален');
    }
}
