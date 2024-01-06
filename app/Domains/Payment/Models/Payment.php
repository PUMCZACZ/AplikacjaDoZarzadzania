<?php

namespace App\Domains\Payment\Models;

use App\Domains\Client\Models\Client;
use App\Domains\Order\Models\Order;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property-read Client client_id
 * @property-read Order order_id
 * @property PaymentStatusEnum status
 */
class Payment extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
