<?php

namespace Modules\Common\Actions;

use Illuminate\Support\Facades\Http;

final readonly class FormatLocal
{
    public function handle(string $local): string | array
    {
        $local = trim(preg_replace('/\s+/', ' ', $local));
        $patterns = [
            '/([\p{L}\s]+)\s?\/\s?([\p{L}\s]{2,})/iu',
            '/([\p{L}\s]+)\s?-\s?([\p{L}]{2})/iu',
            '/([\p{L}\s]+)-([\p{L}]{2})/iu',
            '/([\p{L}\s]+)([\p{L}]{2})/iu',
            '/([\p{L}\s]+)\s?[\.\-]\s?([\p{L}]{2})/iu',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $local, $matches)) {
                $city = ucwords(trim($matches[1]));
                $uf = strtoupper(trim($matches[2]));
                if ($this->verifyCityInState($city, $uf)) {
                    return ['cidade' => $city, 'uf' => $uf];
                } else {
                    return [
                        'cidade' => $city,
                        'uf' => $uf,
                        'message' => 'Uncertain value!'
                    ];
                }
            }
        }

        return null;
    }

    private static function verifyCityInState($city, $uf): bool
    {
        $response = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");

        if ($response->successful()) {
            $cities = $response->json();

            foreach ($cities as $cityData) {
                if (strcoll(mb_strtolower($cityData['nome'], 'UTF-8'), mb_strtolower($city, 'UTF-8')) === 0) {
                    return true; 
                }
            }
        }

        return false;
    }
}
