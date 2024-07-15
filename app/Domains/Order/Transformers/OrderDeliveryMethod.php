<?php

namespace App\Domains\Order\Transformers;

use App\Domains\Order\Enums\OrderDeliveryMethodEnum;
use App\Domains\Order\Models\Order;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class OrderDeliveryMethod extends TransformerAbstract
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
    public function transform(OrderDeliveryMethodEnum $enum): array
    {
        return [
            'name' => $enum->translate(),
            'value' => $enum->value,
        ];
    }
}
