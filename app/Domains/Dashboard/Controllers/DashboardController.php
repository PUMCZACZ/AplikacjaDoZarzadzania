<?php

namespace App\Domains\Dashboard\Controllers;

use App\Domains\Dashboard\Helpers\TransformWeightUnit;
use App\Domains\Order\Enums\OrderTypeEnum;
use App\Domains\Order\Repository\OrderDemandRepository;
use App\Domains\Order\Transformers\DemandTransformer;
use App\Domains\Order\Transformers\OrderTypeTransformer;
use App\Http\Controllers\Controller;
use App\Http\JsonSerializer;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

class DashboardController extends Controller
{
    public function __construct(public OrderDemandRepository $demandRepository)
    {
    }

    public function index()
    {
        $demands = fractal()->item($this->demandRepository->getDemands())
            ->transformWith(new DemandTransformer())
            ->serializeWith(new JsonSerializer())
            ->toJson();

        $demands = $this->demandRepository->getDemands();

        $orderTypes = fractal()->collection(OrderTypeEnum::cases())
            ->transformWith(new OrderTypeTransformer())
            ->serializeWith(new JsonSerializer())
            ->toJson();

        return view('dashboard.index', compact(['orderTypes', 'demands']));
    }
}
