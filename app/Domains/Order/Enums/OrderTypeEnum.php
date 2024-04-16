<?php

namespace App\Domains\Order\Enums;

use Illuminate\Support\Arr;

enum OrderTypeEnum: string
{
    case BAG = 'bag';
    case BIGBAG = 'bigbag';
    case LOOSE = 'loose';
    case PALLET = 'pallet';
    public function translate(): string
    {
        return match ($this) {
          self::BAG => 'Worek',
          self::BIGBAG => 'Big bag',
          self::LOOSE => 'Luz',
          self::PALLET => 'Paleta',
        };
    }

    public static function toValidationRule(): string
    {
        return 'in:'. implode(',', Arr::map(self::cases(), function (OrderTypeEnum $type) {
            return $type->value;
        }));
    }
}
