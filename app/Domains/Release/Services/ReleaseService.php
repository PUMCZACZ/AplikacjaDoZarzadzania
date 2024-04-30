<?php

namespace App\Domains\Release\Services;

use App\Domains\Order\Models\Order;
use App\Domains\Release\Interfaces\ReleaseInterface;
use App\Domains\Release\Models\Release;
use App\Domains\Release\Repositories\ReleaseRepository;

class ReleaseService implements ReleaseInterface
{
    public function __construct(public ReleaseRepository $releaseRepository)
    {

    }
    public function insertRelease(Order $order, float|int $quantity): void
    {
        $releaseInfo = $this->releaseRepository->getOrderReleaseInfo($order);

        if ($releaseInfo['forRelease'] < $quantity) {
            throw new \Exception('Wartość przekracza wydanie podane w zamówieniu');
        }

        Release::create([
            'order_id' => $order->id,
            'quantity' => $quantity,
        ]);
    }

    public function insertFullRelease(Order $order): void
    {
        $releaseInfo = $this->releaseRepository->getOrderReleaseInfo($order);

        if ($releaseInfo['forRelease'] == 0) {
            throw new \Exception('Zamówienie zostało zrealizowane');
        }

        Release::create([
            'order_id' => $order->id,
            'quantity' => $releaseInfo['forRelease'],
        ]);
    }
}
