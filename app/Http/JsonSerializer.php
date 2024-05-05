<?php

namespace App\Http;

use League\Fractal\Serializer\ArraySerializer;

class JsonSerializer extends ArraySerializer
{
    public function collection(?string $resourceKey, array $data): array
    {
        return $data;
    }

    public function item(?string $resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function null(): ?array
    {
        return [];
    }
}
