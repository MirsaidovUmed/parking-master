<?php

namespace App\Http\Controllers;

use App\Models\Whitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WhitelistController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр белый список', ['only' => ['index']]);
        $this->middleware('permission:Добавить белый список', ['only' => ['store']]);
        $this->middleware('permission:Редактировать белый список', ['only' => ['update']]);
        $this->middleware('permission:Удалить белый список', ['only' => ['destroy']]);
    }

    public function index()
    {
        $getWhiteList = Whitelist::latest('id')->paginate(10);
        return view('white-list.index', compact('getWhiteList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|string|max:32',
            'reason'       => 'nullable|string|max:256',
        ]);

        Whitelist::create([
            'plate_number' => $request->plate_number,
            'reason'       => $request->reason,
            'created_by'   => Auth::id() ?? 1,
        ]);

        return redirect()->back()->with('success', 'Номер успешно добавлен в белый список');
    }

    public function update(Request $request, $id)
    {
        $whitelist = Whitelist::findOrFail($id);

        $request->validate([
            'plate_number' => [
                'required',
                'string',
                'max:32',
                Rule::unique('whitelists', 'plate_number')->ignore($whitelist->id),
            ],
            'reason' => 'nullable|string|max:256',
        ]);

        $whitelist->update([
            'plate_number' => $request->plate_number,
            'reason'       => $request->reason,
            'updated_by'   => Auth::id() ?? 1,
        ]);

        return redirect()->back()->with('success', 'Номер успешно обновлен в белом списке');
    }

    public function destroy($id)
    {
        $record = Whitelist::findOrFail($id);
        $record->deleted_by = Auth::id();
        $record->save();
        $record->delete();

        return redirect()->back()->with('success', 'Номер удален из белого списка');
    }
}
