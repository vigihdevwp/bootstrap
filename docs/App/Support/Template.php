<?php

declare(strict_types=1);

namespace App\Support;

use Yiisoft\Html\Html;

final class Template
{

    public static function collapseBtn(string $target, string $title)
    {
        return implode('', [
            Html::openTag('button', [
                'class' => 'btn d-inline-flex align-items-center rounded',
                'data-toggle' => 'collapse',
                'data-target' => '#' . $target,
                'aria-expanded' => 'false',
                'aria-current' => 'true',
                'aria-controls' => $target,
            ]),
            $title,
            Html::closeTag('button'),
        ]);
    }
}
