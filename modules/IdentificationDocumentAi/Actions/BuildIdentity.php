<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\FormatDate;
use Modules\Common\Actions\FormatLocal;
use Modules\Common\Actions\GetValueByType;

final readonly class BuildIdentity
{
    public function __construct(
        private GetValueByType $getValueByType,
        private BuildCpf $buildCpf,
        private FormatDate $formatDate,
        private FormatLocal $formatLocal
    )
    {
    }

    public function handle(array $entities): ?array
    {
        $cpf = $this->buildCpf->handle($entities);
        $rg = $this->getValueByType->handle($entities, 'rg');
        if (!$cpf || !$rg) {
            return null;
        }

        $expeditionDate = $this->formatDate->handle($this->getValueByType->handle($entities, 'data-expedicao'));
        $birthDate =  $this->formatDate->handle($this->getValueByType->handle($entities, 'data-nascimento'));
        $placeOfBirth = $this->formatLocal->handle($this->getValueByType->handle($entities, 'naturalidade'));

        return [
            'nome' => $this->getValueByType->handle($entities, 'nome'),
            'nome_mae' => $this->getValueByType->handle($entities, 'nome-mae'),
            'nome_pai' => $this->getValueByType->handle($entities, 'nome-pai'),
            'cpf' => $cpf,
            'rg' => $rg,
            'data_expedicao' => $expeditionDate,
            'data_nascimento' => $birthDate,
            'naturalidade' => $placeOfBirth,
        ];
    }
}