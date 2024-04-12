<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\GetValueByType;

final readonly class BuildCpf
{
    public function __construct(
        private GetValueByType $getValueByType,
    )
    {
    }

    public function handle(array $entities): ?string
    {
        $cpf = $this->getValueByType->handle($entities, 'cpf');
        $cpf = preg_replace('/\D/', '', $cpf);

        if ($cpf === null || strlen($cpf) != 11) {
            return null;
        }

        $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
        return $cpf;
    }
}