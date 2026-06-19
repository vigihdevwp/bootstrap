<?php

declare(strict_types=1);

namespace App\Support;

use Yiisoft\Html\Html;

final class Collapse
{
    private array $items = [];
    public function __construct(
        private readonly string $id
    ) {}

    public function add(string $label, string $url): self
    {
        $this->items = array_merge($this->items, [implode('', [
            Html::openTag('li'),
            Html::span('radio_button_checked', ['class' => 'material-icons-outlined']),
            Html::a($label, $url, ['class' => 'd-inline-flex align-items-center rounded']),
            Html::closeTag('li'),
        ])]);
        return $this;
    }

    public function render(): string
    {
        return implode('', [
            Html::openTag('div', ['class' => 'collapse', 'id' => $this->id]),
            Html::openTag('ul', ['class' => 'list-unstyled fw-normal pb-1 small']),
            implode('', $this->items),
            Html::closeTag('ul'),
            Html::closeTag('div'),
        ]);
    }
}
