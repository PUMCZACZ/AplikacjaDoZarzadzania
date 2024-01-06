<?php

namespace App\Domains\Order\Controllers;

use App\Domains\Admin\Models\Unit;
use App\Domains\Client\Models\Client;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\OrderRequest;
use App\Domains\Payment\Actions\CreatePaymentAction;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct(protected CreatePaymentAction $createPaymentAction)
    {
    }
    public function index()
    {
        $orders = Order::with(['client', 'unit'])->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::get();
        $units = Unit::get();

        return view('orders.create', compact('clients', 'units'));
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        $this->createPaymentAction->handle($request, $order);

        return redirect()->route('orders.index')->with('success', __("Pomyślnie dodano zamówienie"));
    }

    public function edit(Order $order)
    {
        $order->load(['client', 'unit', 'payments']);

        $clients = Client::get();
        $units = Unit::get();

        return view('orders.edit', compact('order', 'clients', 'units'));
    }

    public function update(Order $order, OrderRequest $request)
    {
        $order->update($request->validated());

        return redirect()->route('orders.index')->with('success', "Pomyślnie dodano zamówienie");
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', "Pomyślnie usunięto zamówienie");
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
