<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр подписок', ['only' => ['index']]);
        $this->middleware('permission:Добавить подписку', ['only' => ['store']]);
        $this->middleware('permission:Изменить подписку', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить подписку', ['only' => ['destroy']]);
        $this->middleware('permission:История подписок', ['only' => ['history']]);
    }

    public function index()
    {
        $subscriptions = Subscription::latest('id')->paginate(10);

        // Преобразуем суммы в сомони для отображения
        foreach ($subscriptions as $sub) {
            $sub->cost = CurrencyHelper::toSomoni($sub->cost);
        }

        return view('subscriptions.index', compact('subscriptions'));
    }

    public function history(Request $request)
    {
        $query = SubscriptionHistory::with('subscription:id,name,cost');

        if ($request->filled('plate_number')) {
            $query->where('plate_number', $request->plate_number);
        }

        $listHistory = $query->paginate(10);

        // Преобразуем суммы в сомони
        foreach ($listHistory as $history) {
            if ($history->subscription) {
                $history->subscription->cost = CurrencyHelper::toSomoni($history->subscription->cost);
            }
        }

        return view('subscriptions.history', compact('listHistory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64|unique:subscriptions,name',
            'cost' => 'required|numeric|min:0',
        ]);

        Subscription::create([
            'name'       => $request->name,
            // сохраняем в дирамах
            'cost'       => CurrencyHelper::toDiram($request->cost),
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Подписка успешно создана');
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        // показываем в сомони
        $subscription->cost = CurrencyHelper::toSomoni($subscription->cost);

        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:64|unique:subscriptions,name,' . $subscription->id,
            'cost' => 'required|numeric|min:0',
        ]);

        $subscription->update([
            'name'       => $request->name,
            // сохраняем в дирамах
            'cost'       => CurrencyHelper::toDiram($request->cost),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Подписка успешно обновлена');
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        // сохраняем кто удалил
        $subscription->deleted_by = Auth::id();
        $subscription->save();

        // выполняем soft delete (поставит deleted_at)
        $subscription->delete();

        return redirect()->back()->with('success', 'Подписка успешно удалена');
    }
}
