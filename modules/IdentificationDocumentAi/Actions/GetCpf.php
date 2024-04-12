<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\ProcessDocument;
use Modules\Common\Actions\RepeatedFieldToArray;
use Modules\Common\DTOs\DocumentAiDTO;

final readonly class GetCpf
{
    public function __construct(
        private ProcessDocument $processDocument,
        private RepeatedFieldToArray $repeatedFieldToArray,
        private BuildCpf $buildCpf,
    )
    {
    }

    public function handle(DocumentAiDTO $dto): array
    {
        $processorId = env('DOCUMENT_AI_CPF_PROCESSOR_ID');
        $document = $this->processDocument->handle($dto, $processorId);
        $entities = $this->repeatedFieldToArray->handle($document->getEntities());

        $cpf = $this->buildCpf->handle($entities);

        return [
            'cpf' => $cpf,
        ];
    }
}