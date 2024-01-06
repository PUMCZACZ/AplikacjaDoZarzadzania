<?php

namespace App\Domains\Order\Requests;

use App\Domains\Order\Enums\OrderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => ['required','integer','exists:clients,id'],
            'order_name' => ['required','string','max:255'],
            'order_type' => ['required', OrderTypeEnum::toValidationRule()],
            'quantity' => ['required','numeric','min:0.01'],
            'price' => ['required','numeric','min:0.01'],
            'deadline' => ['required','date'],
            'unit_id' => ['required','exists:units,id']
        ];
    }
}
