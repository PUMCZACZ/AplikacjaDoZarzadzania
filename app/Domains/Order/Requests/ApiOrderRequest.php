<?php

namespace App\Domains\Order\Requests;

use App\Domains\Order\Enums\OrderDeliveryMethodEnum;
use Illuminate\Foundation\Http\FormRequest;

class ApiOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day' => ['required', 'in:1,3,7,all'],
            'delivery_type' => ['required', 'in:on site,delivery to client,all'],
        ];
    }
}
