<?php

namespace App\Domains\Order\Enums;

use Illuminate\Support\Arr;
use function Laravel\Prompts\select;

enum OrderDeliveryMethodEnum: string
{
    case ON_SITE = 'on site';
    case DELIVER_TO_CLIENT = 'delivery to client';


    public static function toArray(): array
    {
        return Arr::mapWithKeys(self::cases(), function (OrderDeliveryMethodEnum $deliveryMethod) {
            return [
                $deliveryMethod->value => self::translateSingle($deliveryMethod->value),
            ];
        });
    }

    public function translate(): string
    {
        return self::translateSingle($this->value);
    }

    public static function toValidationRule(): string
    {
        return 'in:' . implode(',', Arr::map(self::cases(), function (OrderDeliveryMethodEnum $method) {
                return $method->value;
            }));
    }

    protected static function translateSingle(string $type): string
    {
        return match ($type) {
            self::ON_SITE->value => 'Na miejscu',
            self::DELIVER_TO_CLIENT->value => 'Dowóz do klienta',
        };
    }
}
