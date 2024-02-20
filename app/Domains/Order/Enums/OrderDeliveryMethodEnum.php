<?php

namespace App\Domains\Order\Enums;

use Illuminate\Support\Arr;

enum OrderDeliveryMethodEnum: string
{
    case ON_SITE = 'on site';
    case DELIVER_TO_CLIENT = 'delivery to client';

    public function translate(): string
    {
        return match ($this) {
            self:: ON_SITE => 'Na miejscu',
            self::DELIVER_TO_CLIENT => 'Dowóz do klienta',
        };
    }

    public static function toValidationRule(): string
    {
        return 'in:' . implode(',', Arr::map(self::cases(), function (OrderDeliveryMethodEnum $method) {
                return $method->value;
            }));
    }
}
