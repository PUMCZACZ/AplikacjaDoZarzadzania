<?php

namespace App\Domains\Payment\Controllers;

use App\Domains\Order\Models\Order;
use App\Domains\Payment\Repository\OrderPaymentCalculationRepository;
use App\Domains\Payment\Requests\PaymentRequest;
use App\Domains\Payment\Services\PaymentService;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService                  $paymentService,
        public OrderPaymentCalculationRepository $orderPaymentCalculationRepository,
    )
    {
    }

    public function create(Order $order)
    {
        $order->load('client');

        $paymentInfo = $this->orderPaymentCalculationRepository->getOrderPaymentInfo($order);

        return view('payment.create', compact('order', 'paymentInfo'));
    }

    public function store(PaymentRequest $request, Order $order)
    {
        try {
            $this->paymentService->insertPayment($request, $order);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return view('payment.create', $order, compact('order'));
    }

    public function fullPayment(Order $order)
    {
        $order->load('client');

        try {
            $this->paymentService->insetFullPayment($order);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

       return redirect()->route('orders.show', $order)
           ->with('success', 'Pomyślnie zapłaconą całą kwote za zamówienie');
    }
}
