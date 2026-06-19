<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;


final class Template
{

    public static function icon(string $variant): string
    {
        $icons = [
            'primary' => 'done_all',
            'success' => 'done_all',
            'danger' => 'error',
            'error' => 'error',
            'warning' => 'warning',
            'dark' => 'help_outline',
            'info' => 'info',
        ];

        return isset($icons[$variant]) ? $icons[$variant] : 'info';
    }
}
