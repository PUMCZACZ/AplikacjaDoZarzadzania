<?php

namespace App\Domains\Order\Repository;

use App\Domains\Order\Models\Order;
use Carbon\Carbon;

class OrderDemandRepository
{
    public function getNextMonthOrdersDemandSum(): float
    {
        $nextMonth = Carbon::now()->addMonth();
        $dateMonthStart = (clone $nextMonth)->firstOfMonth();
        $dateMonthEnd = (clone $nextMonth)->lastOfMonth();

        return Order::whereBetween('deadline', [$dateMonthStart, $dateMonthEnd])->sum('quantity');
    }

    public function getNextTwoMonthOrdersDemandSum(): float
    {
        $nextTwoMonth = Carbon::now()->addMonths(2);
        $dateTwoMonthStart = (clone $nextTwoMonth)->firstOfMonth();
        $dateTwoMonthEnd = (clone $nextTwoMonth)->lastOfMonth();

        return Order::whereBetween('deadline', [$dateTwoMonthStart, $dateTwoMonthEnd])->sum('quantity');
    }
}
