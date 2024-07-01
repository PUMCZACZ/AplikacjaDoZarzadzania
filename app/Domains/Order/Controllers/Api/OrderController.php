<?php

namespace App\Domains\Order\Controllers\Api;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\ApiOrderRequest;
use App\Domains\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getOrders(ApiOrderRequest $request): string
    {
        $validated = $request->validated();

        $deliveryType = $validated['delivery_type'];
        $dateFrom = $validated['date_from'];
        $dateTo = $validated['date_to'];
        $realisationStatus = $validated['realisation_status'];

        $data = Order::with('client')
            ->when($dateTo, function ($date) use($dateFrom, $dateTo) {
                $date->whereBetween('deadline', [$dateFrom, $dateTo]);
            })
            ->when($deliveryType === 'all', function ($all) {
                $all->whereNotNull('delivery_method');
            })
            ->when($deliveryType !== 'all', function ($deliveryMethod) use($deliveryType) {
                $deliveryMethod->where('delivery_method', $deliveryType);
            })
            ->when($realisationStatus === 'realised', function ($realisedOrder) {
                $realisedOrder->whereNotNull('realised_at');
            })
            ->when($realisationStatus === 'no realised', function ($realisedOrder) {
                $realisedOrder->whereNull('realised_at');
            })
            ->orderBy('deadline')
            ->get();

        $sumPrice = $data->sum('price');
        $sumKg = $data->sum('quantity');

        return fractal()->collection($data)
            ->transformWith(new OrderTransformer())
            ->addMeta(['sumPrice' => $sumPrice, 'sumKg' => $sumKg])
            ->toJson();
    }
}
