<?php

namespace App\Domains\Payment\Enums;

enum PaymentStatusEnum: string
{
    case ISSUED = 'issued';
    case PAID = 'paid';

    public function translate(): string
    {
        return match ($this) {
          self::ISSUED => 'nieopłacona',
          self::PAID => 'zapłacona',
        };
    }
}
