<?php

namespace App\Domains\Dashboard\Controllers\Api;

use App\Domains\Order\Enums\OrderDeliveryMethodEnum;
use App\Domains\Order\Enums\OrderTypeEnum;
use App\Domains\Order\Repository\OrderDemandRepository;
use App\Domains\Order\Transformers\OrderTypeTransformer;
use App\Http\Controllers\Controller;
use App\Http\JsonSerializer;

class DashboardController extends Controller
{
    public function __construct(public OrderDemandRepository $demandRepository)
    {
    }

    public function data()
    {
        $demands = $this->demandRepository->getDemands();

        $orderTypes = fractal()->collection(OrderTypeEnum::cases())
            ->transformWith(new OrderTypeTransformer())
            ->serializeWith(new JsonSerializer())
            ->toArray();

        $deliveryMethods = OrderDeliveryMethodEnum::toArray();

        return response()->json([
            'demands' => $demands,
            'orderTypes' => $orderTypes,
            'deliveryMethods' => $deliveryMethods,
        ]);
    }
}
