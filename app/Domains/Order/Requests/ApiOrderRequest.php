<?php

namespace App\Domains\Order\Requests;

use App\Domains\Order\Enums\OrderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class ApiOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parameter' => ['required', 'in:1,3,7,all'],
        ];
    }
}
