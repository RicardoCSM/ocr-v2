<?php

namespace Modules\Common\DTOs;

use Illuminate\Http\UploadedFile;
use Modules\Common\Support\MimesDocumentAi;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class DocumentAiDTO extends ValidatedDTO
{
    public UploadedFile $document;

    protected function rules(): array
    {
        return [
            'document' => [
                'required',
                'mimes:' . implode(',', array_map(fn($case) => $case->value, MimesDocumentAi::cases())),
                'max:20480',
            ],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}