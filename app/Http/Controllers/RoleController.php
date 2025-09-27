<?php

namespace App\Http\Controllers;

use App\Repository\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private $role;

    public function __construct(RoleRepository $role)
    {
        $this->middleware('permission:Просмот ролей', ['only' => ['index']]);
        $this->middleware('permission:Добавить роль', ['only' => ['create', 'store']]);
        $this->middleware('permission:Изменить роль', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить роль', ['only' => ['destroy']]);
       return $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->index();
        return view('roles/index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles/create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->role->store($request);
        return redirect('/roles/index')->with('status','Role successes full add');
    }

    public function edit($id)
    {
        $role = $this->role->findByIdSingle($id);
        $permissions = Permission::get();
        $role_permissions = DB::table("role_has_permissions")
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('/roles/edit', compact('role', 'permissions', 'role_permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->role->update($request, $id);
        return redirect('/roles/index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $data = $this->role->findByIdSingle($id);
        $data->delete();
        return redirect('/roles/index');
    }
}
