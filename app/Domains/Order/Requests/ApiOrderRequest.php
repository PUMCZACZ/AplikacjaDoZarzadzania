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
            'date_from' => ['date_format:Y-m-d'],
            'date_to' => ['date_format:Y-m-d'],
            'realisation_status' => ['nullable', 'in:realised,no realised'],
            'delivery_type' => ['required', 'in:on site,delivery to client,all'],
        ];
    }
}
