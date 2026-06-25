<?php

declare(strict_types=1);

namespace App\Dto;

final class ColorDto
{
    private $colors = [
        'Jingga',
        'Merah',
        'Merah Muda',
        'Merah Marun',
        'Kuning',
        'Kuning Keemasan',
        'Hijau',
        'Hijau Toska',
        'Hijau Lumut',
        'Biru',
        'Biru Laut',
        'Biru Dongker',
        'Biru Langit',
        'Ungu',
        'Ungu Lavender',
        'Coklat',
        'Coklat Muda',
        'Abu-abu',
        'Hitam',
        'Putih',
        'Krem',
        'Perak',
        'Emas',
        'Nila',
        'Toska',
        'Salem',
        'Magenta',
        'Salmon',
        'Teal',
        'Nude',
        'Pastel',
    ];

    public function __construct() {}

    public function lists(): array
    {
        $colors = [
            'Jingga',
            'Merah',
            'Merah Muda',
            'Merah Marun',
            'Kuning',
            'Kuning Keemasan',
            'Hijau',
            'Hijau Toska',
            'Hijau Lumut',
            'Biru',
            'Biru Laut',
            'Biru Dongker',
            'Biru Langit',
            'Ungu',
            'Ungu Lavender',
            'Coklat',
            'Coklat Muda',
            'Abu-abu',
            'Hitam',
            'Putih',
            'Krem',
            'Perak',
            'Emas',
            'Nila',
            'Toska',
            'Salem',
            'Magenta',
            'Salmon',
            'Teal',
            'Nude',
            'Pastel',
        ];

        $items = [];
        array_map(function (string $value, int $key) use (&$items) {
            $items[$key + 1] = $value;
        }, $colors, array_keys($colors));
        return $items;
    }

    public function seleact2Data(): array
    {
        $items = [];
        array_map(function (string $value, int $key) use (&$items) {
            $items[] = [
                'id' => $key + 1,
                'text' => $value,
            ];
        }, $this->colors, array_keys($this->colors));
        return $items;
    }
}
