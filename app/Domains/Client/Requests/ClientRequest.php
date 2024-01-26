<?php

namespace App\Domains\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'city' => ['required', 'string'],
            'post_code' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'street' => ['required', 'string']
        ];
    }
}
