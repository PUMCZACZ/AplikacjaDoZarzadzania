<?php

namespace App\Domains\Dashboard\Controllers;

use App\Domains\Dashboard\Helpers\TransformKiloToTonsHelper;
use App\Domains\Order\Enums\OrderTypeEnum;
use App\Domains\Order\Repository\OrderDemandRepository;
use App\Domains\Order\Transformers\OrderTypeTransformer;
use App\Http\Controllers\Controller;
use App\Http\JsonSerializer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

class DashboardController extends Controller
{
    public function __construct(public OrderDemandRepository $demandRepository)
    {
    }

    public function index()
    {
        $nextMonthDemand = TransformKiloToTonsHelper::toTons($this->demandRepository->getNextMonthOrdersDemandSum());
        $nextTwoMonthDemand = TransformKiloToTonsHelper::toTons($this->demandRepository->getNextTwoMonthOrdersDemandSum());
        $materialDemand = TransformKiloToTonsHelper::toTons($this->demandRepository->materialDemand());

        $orderTypes = fractal()->collection(OrderTypeEnum::cases())
            ->transformWith(new OrderTypeTransformer())
            ->serializeWith(new JsonSerializer())
            ->toJson();


        return view('dashboard.index', compact([
            'nextMonthDemand',
            'nextTwoMonthDemand',
            'materialDemand',
            'orderTypes'
        ]));
    }
}
