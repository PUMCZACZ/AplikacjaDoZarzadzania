<?php

namespace App\Domains\Payment\Intrefaces;

use App\Domains\Order\Models\Order;
use Illuminate\Http\Request;

interface PaymentInterface
{
    /**
     * Creates an order entry with the specified amount
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function insertPayment(Request $request, Order $order): void;

    /**
     * Creates full payment for the order
     * @var Order $order
     **/
    public function insetFullPayment(Order $order): void;
}
