<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Collapse
{

    private array $toggleOptions = [];
    private array $collapseOptions = [];
    private ?string $content = null;

    public function __construct(
        private readonly string $targetId,
        private readonly string $label
    ) {

        $this->toggleOptions = [
            'type' => 'button',
            'data-toggle' => 'collapse',
            'data-target' => '#' . $this->targetId,
            'aria-expanded' => 'false',
            'aria-controls' => $this->targetId,
        ];

        $this->collapseOptions = [
            'class' => 'collapse',
            'id' => $this->targetId,
        ];
    }

    public function toggleOptions(array $options): self
    {
        $new = clone $this;
        $new->toggleOptions = ArrayHelper::merge($new->toggleOptions, $options);
        return $new;
    }

    public function content(string $content): self
    {
        $new = clone $this;
        $new->content = $content;
        return $new;
    }

    public function render(): string
    {
        return implode('', [
            $this->renderToggle(),
            $this->renderCollapse(),
        ]);
    }

    private function renderToggle(): string
    {
        return implode('', [
            Html::openTag('div', $this->toggleOptions),
            Html::span($this->label, ['class' => 'btn-label']),
            Html::closeTag('div'),
        ]);
    }

    private function renderCollapse(): string
    {
        return implode('', [
            Html::openTag('div', $this->collapseOptions),
            $this->content,
            Html::closeTag('div'),
        ]);
    }
}
