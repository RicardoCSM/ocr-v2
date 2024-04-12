<?php

namespace Modules\Common\Actions;

use Google\Protobuf\Internal\RepeatedField;

final readonly class RepeatedFieldToArray
{
    public function handle(RepeatedField $repeatedField): array
    {
        $array = [];
        foreach ($repeatedField as $item) {
            $array[] = $item;
        }
        return $array;
    }
}
