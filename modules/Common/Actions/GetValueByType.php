<?php

namespace Modules\Common\Actions;

final readonly class GetValueByType
{
    public function handle(array $entities, string $type): ?string
    {
        foreach ($entities as $entity) {
            if ($entity->getType() === $type) {
                if (!empty($entity)) {
                    return $entity->getMentionText();
                } else {
                    return null;
                }
            }
        }

        return null;
    }
}
