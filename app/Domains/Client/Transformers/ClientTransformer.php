<?php

namespace App\Domains\Client\Transformers;

use App\Domains\Client\Models\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Client $client): array
    {
        return [
            'id' => $client->id,
            'full_name' => $client->fullName(),
            'phone_number' => $client->phone_number,
            'full_address' => $client->fullAddress(),
        ];
    }
}
