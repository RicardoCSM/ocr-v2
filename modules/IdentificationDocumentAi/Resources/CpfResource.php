<?php

namespace Modules\IdentificationDocumentAi\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CpfResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cpf' => $this->resource['cpf'] ?? null
        ];
    }
}