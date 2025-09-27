<?php

namespace App\Http\Controllers;

use App\Repository\AccessRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AccessController extends Controller
{
    private $access;

    public function __construct(AccessRepository $access)
    {
        $this->middleware('permission:Просмотр доступы', ['only' => ['index']]);
        $this->middleware('permission:Добавить доступ', ['only' => ['create', 'store']]);
        $this->middleware('permission:Изменить доступ', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить доступ', ['only' => ['destroy']]);
        return $this->access = $access;
    }

    public function index()
    {
        $accesses = Permission::query()->orderBy('category')->paginate(100);
        return view('accesses/index', compact('accesses'));
    }

    public function store(Request $request)
    {
        $this->access->store($request);
        return redirect('accesses/index')->with('status', 'Successes full add');
    }

    public function create()
    {
        return view('/accesses/create');
    }

    public function edit($id)
    {
        $access = $this->access->findByIdSingle($id);
        $categories = Permission::query()->select('category')->groupBy('category')->get();
        return view('accesses/edit', compact('access', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->access->update($request, $id);
        return redirect('accesses/index')->with('success', 'Update permissions successfully');
    }

    public function destroy($id)
    {
        $this->access->deleteID($id);
        return redirect('accesses/index');
    }
}
