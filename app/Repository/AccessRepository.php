<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AccessRepository extends BaseRepository
{
    public function __construct(Permission $access)
    {
        $this->currobject = $access;
    }

    public function store(Request $request)
    {
        $access = $this->currobject::query()
            ->create([
                'name' => $request->input('name'),
                'category' => $request->input('category'),
                'guard_name' => 'web',
            ]);
        $access->save();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
//            'name' => 'required|exists:permissions,name',
            'category' => 'required'
        ]);
        $access = $this->findByIdSingle($id);
        $access->update([
//            'name' => $request->input('name'),
            'category' => $request->input('category'),
//            'guard_name' => 'web',
        ]);
        $access->save();
    }
}
