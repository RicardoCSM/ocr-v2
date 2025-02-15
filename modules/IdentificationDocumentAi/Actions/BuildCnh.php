<?php

namespace Modules\IdentificationDocumentAi\Actions;

use Modules\Common\Actions\GetValueByType;
use Modules\Common\Support\TreatData;

final readonly class BuildCnh
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
        $drivingLicenseCategory = $this->getValueByType->handle($entities, 'categoria-habilitacao');

        if (!$cpf || !$drivingLicenseCategory) {
            return null;
        }

        $issueDate = TreatData::formatDate($this->getValueByType->handle($entities, 'data-emissao'));
        $birthDate =  TreatData::formatDate($this->getValueByType->handle($entities, 'data-nascimento'));
        $placeOfRegister = TreatData::formatLocal($this->getValueByType->handle($entities, 'local'));

        return [
            'nome' => $this->getValueByType->handle($entities, 'nome'),
            'doc_identidade' => $this->getValueByType->handle($entities, 'doc-identidade'),
            'org-emissor' => $this->getValueByType->handle($entities, 'org-emissor'),
            'uf' => $this->getValueByType->handle($entities, 'uf'),
            'validade' => $this->getValueByType->handle($entities, 'validade'),
            'cpf' => $cpf,
            'categoria_habilitacao' => $drivingLicenseCategory,
            'data_emissao' =>  $issueDate,
            'nome_mae' => $this->getValueByType->handle($entities, 'nome-mae'),
            'nome_pai' => $this->getValueByType->handle($entities, 'nome-pai'),
            'data_nascimento' => $birthDate,
            'observacoes' => $this->getValueByType->handle($entities, 'observacoes'),
            'local' => $placeOfRegister,
            'num_registro' => $this->getValueByType->handle($entities, 'num-registro'),
        ];
    }
}