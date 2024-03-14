<?php

namespace App\Domains\Payment\Repository;

use App\Domains\Order\Models\Order;
use App\Domains\Payment\Models\Payment;
use Illuminate\Support\Collection;


class OrderPaymentCalculationRepository
{
    public function getOrderPaymentInfo(Order $order): array
    {
        $payed = Payment::where('order_id', $order->id)->sum('amount');
        $toPay = $order->price - $payed;

        return [
            'payed' => $payed,
            'toPay' => $toPay,
        ];
    }
}
