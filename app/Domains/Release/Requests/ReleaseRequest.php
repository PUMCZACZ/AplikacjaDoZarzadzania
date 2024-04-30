<?php

namespace App\Domains\Release\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $order = $this->route('order');

        return [
            'quantity' => ['required', 'numeric', 'min:1', "max:$order->quantity"],
        ];
    }
}
