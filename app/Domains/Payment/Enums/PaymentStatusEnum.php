<?php

namespace App\Domains\Payment\Enums;

use Illuminate\Support\Arr;

enum PaymentStatusEnum: string
{
    case ISSUED = 'issued';
    case PAID = 'paid';

    public function translate(): string
    {
        return match ($this) {
          self::ISSUED => 'Nieopłacona',
          self::PAID => 'Zapłacona',
        };
    }

    public static function toValidationRule(): string
    {
        return 'in:' . implode(',', Arr::map(self::cases(), function (PaymentStatusEnum $status) {
                return $status->value;
            }));
    }
}
