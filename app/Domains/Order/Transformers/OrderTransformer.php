<?php

namespace App\Domains\Order\Transformers;

use App\Domains\Order\Models\Order;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order): array
    {
        return [
            'id' => $order->id,
            'client' => $order->client->fullName(),
            'order_name' => $order->order_name,
            'order_type' => $order->order_type->translate(),
            'quantity' => $order->quantity,
            'unit' => $order->unit?->name,
            'price' => $order->price . 'zł',
            'deadline' => Carbon::parse($order->deadline)->format('d-m-Y') ?? '',
        ];
    }
}
