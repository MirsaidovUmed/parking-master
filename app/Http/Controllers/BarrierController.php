<?php

namespace App\Http\Controllers;

use App\Repository\BarrierRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BarrierController extends Controller
{
    private $barriers;

    public function __construct(BarrierRepository $barriers)
    {
        $this->middleware('permission:Просмотр шлагбаумов', ['only' => ['index']]);
        $this->middleware('permission:Создать шлагбаум', ['only' => ['store']]);
        $this->middleware('permission:Изменить шлагбаум', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить шлагбаум', ['only' => ['destroy']]);
        $this->barriers = $barriers;
    }

    public function index()
    {
        $items = $this->barriers->index();
        return view('barriers.index', compact('items'));
    }

    public function store(Request $request)
    {
        $this->barriers->store($request);
        return redirect()->back()->with('success', 'Шлагбаум создан');
    }

    public function edit($id)
    {
        $item = $this->barriers->findByIdSingle($id);
        return view('barriers.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $barrier = $this->barriers->findByIdSingle($id);

        // Если статус меняется вручную (opened/closed) — режим становится manual
        if ($request->has('status') && in_array($request->input('status'), ['opened','closed'])) {
            $request->merge(['mode' => 'manual']);
        }

        $updated = $this->barriers->update($request, $id);

        // Вызываем управление устройством при смене статуса
        if ($request->has('status') && in_array($request->input('status'), ['opened','closed'])) {
            $flag = $request->input('status') === 'opened' ? 'true' : 'false';
            $url = sprintf('http://host.docker.internal:%d/open&flag=%s', (int) $barrier->barrierport, $flag);
            try {
                Http::timeout(3)->get($url);
            } catch (\Throwable $e) {
                // Опционально: логировать
            }
        }

        // Если вернули авто-режим, статус дальше управляет система
        return redirect()->route('barriers.index')->with('success', 'Шлагбаум обновлён');
    }

    public function destroy($id)
    {
        $this->barriers->deleteID($id);
        return redirect()->back();
    }

    // Лайв-управление: вход — переключаем на manual и показываем экран управления
    public function liveEnter(Request $request)
    {
        $id = (int) $request->input('id');
        $barrier = $this->barriers->findByIdSingle($id);
        $req = new Request([
            'mode' => 'manual',
            'status' => $barrier->status === 'none' ? 'closed' : $barrier->status,
        ]);
        $this->barriers->update($req, $id);
        $barrier = $this->barriers->findByIdSingle($id);
        return view('barriers.live', compact('barrier'));
    }

    // Лайв: открыть
    public function liveOpen($id)
    {
        $barrier = $this->barriers->findByIdSingle($id);
        try {
            $url = sprintf('http://host.docker.internal:%d/open&flag=true', (int) $barrier->barrierport);
            Http::timeout(3)->get($url);
        } catch (\Throwable $e) {}
        $this->barriers->update(new Request(['mode' => 'manual','status' => 'opened']), $id);
        return redirect()->back();
    }

    // Лайв: закрыть
    public function liveClose($id)
    {
        $barrier = $this->barriers->findByIdSingle($id);
        try {
            $url = sprintf('http://host.docker.internal:%d/open&flag=false', (int) $barrier->barrierport);
            Http::timeout(3)->get($url);
        } catch (\Throwable $e) {}
        $this->barriers->update(new Request(['mode' => 'manual','status' => 'closed']), $id);
        return redirect()->back();
    }

    // Лайв: выход — вернуть auto + none
    public function liveExit($id)
    {
        $this->barriers->update(new Request(['mode' => 'auto','status' => 'none']), $id);
        return redirect()->route('barriers.index');
    }

    // Массовые действия: open/close выбранные
    public function bulk(Request $request)
    {
        $action = $request->input('action');
        $ids = collect(explode(',', (string) $request->input('ids')))
            ->filter(fn($v) => is_numeric($v))
            ->map(fn($v) => (int) $v)
            ->all();

        foreach ($ids as $id) {
            $barrier = $this->barriers->findByIdSingle($id);
            if (!$barrier) continue;
            if ($action === 'open') {
                try {
                    $url = sprintf('http://host.docker.internal:%d/open&flag=true', (int) $barrier->barrierport);
                    Http::timeout(3)->get($url);
                } catch (\Throwable $e) {}
                $this->barriers->update(new Request(['mode' => 'manual','status' => 'opened']), $id);
            } elseif ($action === 'close') {
                try {
                    $url = sprintf('http://host.docker.internal:%d/open&flag=false', (int) $barrier->barrierport);
                    Http::timeout(3)->get($url);
                } catch (\Throwable $e) {}
                $this->barriers->update(new Request(['mode' => 'manual','status' => 'closed']), $id);
            }
        }

        return redirect()->back()->with('success', 'Операция выполнена');
    }
}


