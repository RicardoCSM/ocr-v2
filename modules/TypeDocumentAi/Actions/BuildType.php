<?php

namespace Modules\TypeDocumentAi\Actions;

final readonly class BuildType
{
    public function handle(array $entities): ?string
    {
        $highestConfidence = 0.0;
        $type = null;

        foreach ($entities as $entity) {
            $confidence = $entity->getConfidence();
            if ($confidence > $highestConfidence) {
                $highestConfidence = $confidence;
                $type = $entity->getType();
            }
        }

        if (empty($type) || $highestConfidence < 0.5) {
            return null;
        }

        return $type;
    }
}
