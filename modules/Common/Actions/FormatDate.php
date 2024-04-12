<?php

namespace Modules\Common\Actions;

final readonly class FormatDate
{
    public function handle(string $date): string | array
    {
        $formats = [
            'd/m/y',
            'd-m-y',
            'd - m - Y',
            'd/m/Y',
            'd.m.Y',
            'd.m.y',
            'd/\\m/Y',
            'd-M-y',
            'd-M-Y',
            'd/F/y',
            'd/F/Y',
        ];

        foreach ($formats as $format) {
            $formatedDate = \DateTime::createFromFormat($format, $date);
            if ($formatedDate !== false) {
                return $formatedDate->format('d/m/Y');
            }
        }

        return [
            'data' => $date,
            'message' => 'Uncertain value!'
        ];
    }
}
