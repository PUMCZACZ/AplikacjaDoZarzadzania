<?php

namespace App\Domains\Release\Repositories;

use App\Domains\Order\Models\Order;
use App\Domains\Release\Models\Release;
use Illuminate\Support\Collection;

class ReleaseRepository
{
    public function getOrderReleaseInfo(Order $order): Collection
    {
        $released = $this->getOrderReleaseSum($order);

        $forRelease = $order->quantity - $released;

        return collect(['released' => $released, 'forRelease' => $forRelease]);
    }
    private function getOrderReleaseSum(Order $order): float
    {
        return Release::where('order_id', $order->id)->sum('quantity');
    }
}
