<?php

namespace Modules\TypeDocumentAi\Actions;

use Modules\Common\Actions\ProcessDocument;
use Modules\Common\Actions\RepeatedFieldToArray;
use Modules\Common\DTOs\DocumentAiDTO;
use Modules\Common\Exceptions\InvalidDocumentException;

final readonly class GetType
{
    public function __construct(
        private ProcessDocument $processDocument,
        private RepeatedFieldToArray $repeatedFieldToArray,
        private BuildType $buildType,
    )
    {
    }

    public function handle(DocumentAiDTO $dto): array
    {
        $processorId = env('DOCUMENT_AI_TYPE_PROCESSOR_ID');
        $document = $this->processDocument->handle($dto, $processorId);
        $entities = $this->repeatedFieldToArray->handle($document->getEntities());

        $type = $this->buildType->handle($entities);

        if($type == null) {
            throw new InvalidDocumentException;
        }

        return [
            'type' => $type,
        ];
    }
}