<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\FormatDate;
use Modules\Common\Actions\FormatLocal;
use Modules\Common\Actions\GetValueByType;
use Modules\Common\Support\TreatData;

final readonly class BuildIdentity
{
    public function __construct(
        private GetValueByType $getValueByType,
        private BuildCpf $buildCpf
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

        $expeditionDate = TreatData::formatDate($this->getValueByType->handle($entities, 'data-expedicao'));
        $birthDate =  TreatData::formatDate($this->getValueByType->handle($entities, 'data-nascimento'));
        $placeOfBirth = TreatData::formatLocal($this->getValueByType->handle($entities, 'naturalidade'));

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