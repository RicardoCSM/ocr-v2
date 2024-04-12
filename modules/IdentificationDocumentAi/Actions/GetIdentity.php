<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\ProcessDocument;
use Modules\Common\Actions\RepeatedFieldToArray;
use Modules\Common\DTOs\DocumentAiDTO;
use Modules\Common\Exceptions\InvalidDocumentException;

final readonly class GetIdentity
{
    public function __construct(
        private ProcessDocument $processDocument,
        private RepeatedFieldToArray $repeatedFieldToArray,
        private BuildIdentity $buildIdentity,
    )
    {
    }

    public function handle(DocumentAiDTO $dto): ?array
    {
        $processorId = env('DOCUMENT_AI_IDENTITY_PROCESSOR_ID');
        $document = $this->processDocument->handle($dto, $processorId);
        $entities = $this->repeatedFieldToArray->handle($document->getEntities());

        $identityData = $this->buildIdentity->handle($entities);

        if($identityData == null) {
            throw new InvalidDocumentException;
        }

        return $identityData;
    }
}