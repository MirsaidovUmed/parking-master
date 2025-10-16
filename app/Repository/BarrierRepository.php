<?php

namespace App\Repository;

use App\Models\Barrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarrierRepository extends BaseRepository
{
    public function __construct(Barrier $barrier)
    {
        $this->currobject = $barrier;
    }

    public function store(Request $request)
    {
        $request->validate([
            'barrierport' => 'required|integer|min:1|max:65535',
            'direction' => 'required|in:in,out',
        ]);

        return $this->currobject::create([
            'name' => $request->input('name'),
            'barrierport' => (int) $request->input('barrierport'),
            'direction' => $request->input('direction'),
            'mode' => 'auto',
            'status' => 'none',
            'created_by' => Auth::id() ?? 1,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mode' => 'required|in:auto,manual',
            'status' => 'required|in:opened,closed,none',
        ]);

        $barrier = $this->findByIdSingle($id);

        $newMode = $request->input('mode');
        $newStatus = $request->input('status');

        // Если выбран режим auto — статус должен быть none
        if ($newMode === 'auto') {
            $newStatus = 'none';
        }

        $barrier->update([
            'mode' => $newMode,
            'status' => $newStatus,
            'updated_by' => Auth::id() ?? 1,
        ]);

        return $barrier;
    }
}


