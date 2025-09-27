<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Просмотр подписка', ['only' => ['index']]);
        $this->middleware('permission:Добавить подписка', ['only' => ['store']]);
        $this->middleware('permission:Изменить подписка', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Удалить подписка', ['only' => ['destroy']]);
        $this->middleware('permission:История подписка', ['only' => ['history']]);
    }

    public function index()
    {
        $subscriptions = Subscription::paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function history(Request $request)
    {
        $query = SubscriptionHistory::with('subscription:id,name,cost');

        if ($request->filled('plate_number')) {
            $query->where('plate_number', $request->plate_number);
        }

        $history = $query->paginate(10);
        return view('subscriptions.history', compact('history'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:64|unique:subscriptions,name',
            'cost' => 'required|integer|min:0',
        ]);

        Subscription::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Подписка успешно создана');
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:64|unique:subscriptions,name,' . $subscription->id,
            'cost' => 'required|integer|min:0',
        ]);

        $subscription->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Подписка успешно обновлена');
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update([
            'deleted_at' => Carbon::now(),
            'deleted_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Подписка успешно удалена');
    }
}
