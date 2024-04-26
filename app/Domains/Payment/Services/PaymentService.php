<?php

namespace App\Domains\Payment\Services;

use App\Domains\Order\Models\Order;
use App\Domains\Payment\Exceptions\DepositAmountToLargeException;
use App\Domains\Payment\Exceptions\OrderPayedException;
use App\Domains\Payment\Intrefaces\PaymentInterface;
use App\Domains\Payment\Models\Payment;
use App\Domains\Payment\Repository\OrderPaymentCalculationRepository;
use Illuminate\Http\Request;

class PaymentService implements PaymentInterface
{
    public function __construct(protected OrderPaymentCalculationRepository $orderPaymentCalculationRepository)
    {
    }

    /**
     * @throws DepositAmountToLargeException
     */
    public function insertPayment(Request $request, Order $order): void
    {
        if ($this->canInsertPayment($request, $order)) {
            throw new DepositAmountToLargeException('Suma wpłaty przekracza wartość zamówienia');
        }
        Payment::create([
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'amount' => $request->payment_amount ?? 0,
        ]);
    }

    public function insetFullPayment(Order $order): void
    {
        $paymentInfo = $this->orderPaymentCalculationRepository->getOrderPaymentInfo($order);

        if ($paymentInfo['toPay'] === 0.0) {
            throw new OrderPayedException('To zamówienie jest już uregulowane!');
        }

        Payment::create([
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'amount' => $paymentInfo['toPay'],
        ]);
    }

    private function canInsertPayment(Request $request, Order $order): bool
    {
        $paymentInfo = $this->orderPaymentCalculationRepository->getOrderPaymentInfo($order);

        return ($request->payment_amount + $paymentInfo['toPay']) <= $order->price;
    }
}
