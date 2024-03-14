<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Client\Models\Client;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\OrderRequest;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use App\Domains\Payment\Models\Payment;
use Illuminate\Http\Request;

class PaymentAction
{
    public function handle(Request $request, Order $order): void
    {
        Payment::create([
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'amount' => $request->amount ?? 0,
        ]);
    }
}
