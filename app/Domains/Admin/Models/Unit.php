<?php

namespace App\Domains\Admin\Models;

use App\Domains\Order\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property int name
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Unit extends Model
{
    protected $table = 'units';

    protected $guarded = [];

    public function Order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
