<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\ProcessDocument;
use Modules\Common\Actions\RepeatedFieldToArray;
use Modules\Common\DTOs\DocumentAiDTO;
use Modules\Common\Exceptions\InvalidDocumentException;

final readonly class GetCnh
{
    public function __construct(
        private ProcessDocument $processDocument,
        private RepeatedFieldToArray $repeatedFieldToArray,
        private BuildCnh $buildCnh,
    )
    {
    }

    public function handle(DocumentAiDTO $dto): ?array
    {
        $processorId = env('DOCUMENT_AI_CNH_PROCESSOR_ID');
        $document = $this->processDocument->handle($dto, $processorId);
        $entities = $this->repeatedFieldToArray->handle($document->getEntities());

        $cnhData = $this->buildCnh->handle($entities);

        if($cnhData == null) {
            throw new InvalidDocumentException;
        }

        return $cnhData;
    }
}