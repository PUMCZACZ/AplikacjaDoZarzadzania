<?php

namespace App\Domains\Order\Models;

use App\Domains\Admin\Models\Unit;
use App\Domains\Client\Models\Client;
use App\Domains\Order\Enums\OrderDeliveryMethodEnum;
use App\Domains\Order\Enums\OrderTypeEnum;
use App\Domains\Payment\Models\Payment;
use App\Domains\Release\Models\Release;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int client_id
 * @property string order_name
 * @property OrderTypeEnum order_type
 * @property float package_quantity
 * @property float quantity
 * @property double price
 * @property OrderDeliveryMethodEnum delivery_method
 * @property Carbon deadline
 * @property Carbon realised_at
 * @property-read Client $client
 * @property-read Unit $unit
 * @property-read Release $release
 */
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'order_type' => OrderTypeEnum::class,
        'delivery_method' => OrderDeliveryMethodEnum::class,
        'deadline' => 'datetime',
        'realised_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function deadlineDate(): string
    {
        return Carbon::parse($this->deadline)->format('d-m-Y') ?? '';
    }

    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }
}
