<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Client\Models\Client;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\OrderRequest;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use App\Domains\Payment\Models\Payment;

class PaymentAction
{
    public function handle(OrderRequest $request, Order $order): void
    {
        Payment::create([
            'order_id' => $order->id,
            'client_id' => $request->client_id,
            'status' => $request->payment_status,
            'amount' => $request->amount ?? 0,
        ]);
    }
}
