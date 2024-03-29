<?php

namespace App\Domains\Order\Controllers\Api;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\ApiOrderRequest;
use App\Domains\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function getOrders(ApiOrderRequest $request)
    {
        $day = $request->day;
        $deliveryType = $request->delivery_type;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

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
            ->orderBy('deadline')
            ->get();

        $sumPrice = $data->sum('price');
        $sumKilo = $data->sum('quantity');

        return fractal()->collection($data)
            ->transformWith(new OrderTransformer())
            ->addMeta(['sumPrice' => $sumPrice, 'sumKilo' => $sumKilo])
            ->toJson();
    }
}
