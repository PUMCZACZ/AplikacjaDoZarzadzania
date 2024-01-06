<?php

namespace App\Domains\Client\Models;

use App\Domains\Order\Models\Order;
use App\Domains\Payment\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string city
 * @property int phone_number
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property-read Order $order
 */
class Client extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
