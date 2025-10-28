<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр зоны', ['only' => ['index']]);
        $this->middleware('permission:Создание зоны', ['only' => ['store']]);
        $this->middleware('permission:Изменить зону', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить зону', ['only' => ['destroy']]);
    }

    public function index()
    {
        $zones = Zone::paginate(10);

        return view('zones.index', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:64',
        ]);

        $zone = new Zone();

        $zone->name = $request->input('name');

        $zone->save();

        return redirect()->back()->with('success', "Зона успешно создана");
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'             => 'required|string|max:64',
        ]);

        $zone = Zone::findOrFail($id);

        $zone->name = $request->input('name');

        $zone->update();

        return redirect()->back()->with('success', "Зона успешно обновлена");
    }

    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);

        $hasTariffs = Tariff::where('zone_id', $zone->id)->exists();

        if ($hasTariffs) {
            return redirect()->back()
                ->with('error', "Невозможно удалить зону '{$zone->name}', так как она используется в тарифах.
                             Сначала отвяжите её от тарифов.");
        }

        $zone->delete();

        return redirect()->back()->with('success', "Зона '{$zone->name}' успешно удалена");
    }

}
