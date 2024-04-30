<?php

namespace App\Domains\Order\Controllers;

use App\Domains\Admin\Models\Unit;
use App\Domains\Client\Models\Client;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\OrderRequest;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use App\Domains\Payment\Models\Payment;
use App\Domains\Payment\Repository\OrderPaymentCalculationRepository;
use App\Domains\Payment\Services\PaymentService;
use App\Domains\Release\Repositories\ReleaseRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
        protected OrderPaymentCalculationRepository $orderPaymentCalculationRepository,
        protected ReleaseRepository $releaseRepository,
    )
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

        return view('orders.create', compact('clients', ));
    }

    public function store(OrderRequest $request)
    {
        $validated = $request->validatedExcept(['payment_status', 'payment_amount']);

        $validated['unit_id'] = Unit::where('name', 'kg')->first()->id;

        DB::transaction(function () use($validated, $request) {
            $order = Order::create($validated);

            if ($request->payment_status === PaymentStatusEnum::ISSUED) {
                $this->paymentService->insertPayment($request, $order);
            } else {
                $this->paymentService->insetFullPayment($order);
            }
        });

        return redirect()->route('orders.index')->with('success', __("Pomyślnie dodano zamówienie"));
    }

    public function edit(Order $order)
    {
        $order->load(['client', 'unit', 'payments']);

        $paymentStatus = Payment::where('order_id', $order->id)->latest()->first();
        $clients = Client::get();

        return view('orders.edit', compact('order', 'clients', 'paymentStatus'));
    }

    public function update(Order $order, OrderRequest $request)
    {
        $validated = $request->validatedExcept(['payment_status', 'payment_amount']);

        $validated['unit_id'] = Unit::where('name', 'kg')->first()->id;

        DB::transaction(function () use($validated, $order) {
            $order->update($validated);
        });

        return redirect()->route('orders.index')->with('success', "Pomyślnie dodano zamówienie");
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', "Pomyślnie usunięto zamówienie");
    }

    public function show(Order $order)
    {
        $order->load(['payments', 'releases']);

        $paymentInfo = $this->orderPaymentCalculationRepository->getOrderPaymentInfo($order);
        $releaseInfo = $this->releaseRepository->getOrderReleaseInfo($order);

        return view('orders.show', compact('order', 'paymentInfo', 'releaseInfo'));
    }

    public function realise(Order $order)
    {
        $order->realised_at = Carbon::now()->toDateTime();
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Pomyślnie zmieniono status zamówienia');
    }
}
