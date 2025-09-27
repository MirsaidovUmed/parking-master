<?php

namespace App\Repository;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        $this->currobject = $user;
    }

    public function store(Request $request)
    {
        $user = User::query()->create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'created_by' => 1
        ]);
        $user->assignRole($request->input('roles'));
        $user->save();
    }

    public function update(Request $request, $id)
    {
        $user = $this->findByIdSingle($id);
        $user->update([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);
        $role = Role::find($request->input('role_id'));
        $user->syncRoles([$role->name]);
        $user->save();
    }
}
