<?php

namespace App\Domains\Release\Interfaces;

use App\Domains\Order\Models\Order;

interface ReleaseInterface
{
    /**
     * Insert release info with specified quantity for order
     * @param Order $order
     * @param int|float $quantity
     * @return void
     */
    public function insertRelease(Order $order,int|float $quantity): void;

    /**
     * Insert full release info for order
     * @param Order $order
     * @return void
     */
    public function insertFullRelease(Order $order): void;
}
