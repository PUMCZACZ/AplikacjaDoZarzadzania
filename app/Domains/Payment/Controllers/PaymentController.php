<?php

namespace App\Domains\Payment\Controllers;

use App\Domains\Order\Models\Order;
use App\Domains\Payment\Actions\PaymentAction;
use App\Domains\Payment\Repository\OrderPaymentCalculationRepository;
use App\Domains\Payment\Requests\PaymentRequest;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentAction                  $paymentAction,
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
        $paymentInfo = $this->orderPaymentCalculationRepository->getOrderPaymentInfo($order);

        if ($request->amount > $paymentInfo['toPay']) {
            return back()->withErrors('Zapłacona kwota przekracza wartość zakupu');
        }

        $this->paymentAction->handle($request, $order);

        return view('payment.create', $order, compact('order', 'paymentInfo'));
    }


}
