<?php

namespace App\Domains\Release\Models;

use App\Domains\Order\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property Order $order_id
 * @property float $quantity,
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Release extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
