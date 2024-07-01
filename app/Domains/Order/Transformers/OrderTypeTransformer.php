<?php

namespace App\Domains\Order\Transformers;

use App\Domains\Order\Enums\OrderTypeEnum;
use App\Domains\Order\Models\Order;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class OrderTypeTransformer extends TransformerAbstract
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
    public function transform(OrderTypeEnum $orderTypeEnum): array
    {
        return [
            'value' => $orderTypeEnum->value,
            'name' => $orderTypeEnum->translate(),
        ];
    }
}
