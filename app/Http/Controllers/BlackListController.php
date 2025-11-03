<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlackListController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр черный список', ['only' => ['index']]);
        $this->middleware('permission:Добавить черный список', ['only' => ['store']]);
        $this->middleware('permission:Редактировать черный список', ['only' => ['update']]);
        $this->middleware('permission:Удалить черный список', ['only' => ['destroy']]);
    }

    public function index()
    {
        $getBlackList = BlackList::latest('id')->paginate(10);
        return view('black-list.index', compact('getBlackList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number'   => 'required|string|max:32',
            'reason'         => 'nullable|string|max:256',
            'direction_in'   => 'nullable|in:on,1,0',
            'direction_out'  => 'nullable|in:on,1,0',
        ]);

        BlackList::create([
            'plate_number'  => $request->plate_number,
            'reason'        => $request->reason,
            'direction_in'  => $request->has('direction_in') ? 1 : 0,
            'direction_out' => $request->has('direction_out') ? 1 : 0,
            'created_by'    => Auth::id() ?? 1,
        ]);

        return redirect()->back()->with('success', 'Номер успешно добавлен в черный список');
    }

    public function update(Request $request, $id)
    {
        $blacklist = BlackList::findOrFail($id);


        $request->validate([
            'plate_number' => "required|string|max:32|unique:blacklists,plate_number,{$id}",
            'reason'         => 'nullable|string|max:256',
            'direction_in'   => 'nullable|in:on,1,0',
            'direction_out'  => 'nullable|in:on,1,0',
        ]);

            $blacklist->update([
            'plate_number'  => $request->plate_number,
            'reason'        => $request->reason,
            'direction_in'  => $request->has('direction_in') ? 1 : 0,
            'direction_out' => $request->has('direction_out') ? 1 : 0,
            'updated_by'    => Auth::id() ?? 1,
        ]);

        return redirect()->back()->with('success', 'Номер успешно успешно обновлен');
    }

    public function destroy($id)
    {
        $record = BlackList::findOrFail($id);
        $record->deleted_at = Carbon::now();
        $record->deleted_by = Auth::id();
        $record->save();
        $record->delete();

        return redirect()->back()->with('success', 'Номер удален из черного списка');
    }
}
