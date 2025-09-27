<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        $this->currobject = $role;
    }

    public function store(Request $request)
    {
        $role = $this->currobject::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('web')
        ]);
        $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
        $role->syncPermissions($permissions);
        $role->save();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id',
        ]);

        $role = $this->currobject::findOrFail($id);
        $role->update([
           'name' => $request->input('name'),
        ]);

        $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
        $role->syncPermissions($permissions);
        $role->save();
    }

}
