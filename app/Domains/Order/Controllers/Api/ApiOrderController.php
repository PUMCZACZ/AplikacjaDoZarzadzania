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
        $currentDate = Carbon::now()->toDateString();
        $req = $request->parameter;

        $data = Order::with('client')
            ->when($req === '1', function ($oneDay) use($currentDate) {
            $oneDay->where('deadline', $currentDate);
        })
            ->when($req === '3', function ($threeDays) use($currentDate) {
                $threeDays->whereBetween('deadline', [$currentDate, Carbon::now()->addDays(3)->toDateString()]);
            })
            ->when($req === '7', function ($sevenDays) use($currentDate) {
                $sevenDays->whereBetween('deadline', [$currentDate, Carbon::now()->addDays(7)->toDateString()]);
            })
            ->when($req === 'all', function ($all) {
                $all->whereNull('realised_at');
            })
            ->orderBy('deadline')
            ->get();

        $sum = $data->sum('price');

        return fractal()->collection($data)
            ->transformWith(new OrderTransformer())
            ->addMeta(['sumPrice' => $sum])
            ->toJson();
    }
}
