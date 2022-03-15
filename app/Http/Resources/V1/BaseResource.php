<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;

class BaseResource extends JsonResource
{
    public function __construct($resource)
    {
        $this->additional(self::resourceAdditional());
        parent::__construct($resource);
    }

    private static function resourceAdditional(): array
    {
        return [
            'code' => 200,
            'timestamp' => now()->timestamp,
        ];
    }

    public static function collection($resource): AnonymousResourceCollection
    {
        return parent::collection($resource)->additional(self::resourceAdditional());
    }

    public function toResponse($request): JsonResponse
    {
        $resourceResponse = (new ResourceResponse($this))->toResponse($request);
        $resourceResponse->setStatusCode($this->additional['code']);
        return $resourceResponse;
    }
}
