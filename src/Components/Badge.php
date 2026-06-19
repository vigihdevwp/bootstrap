<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Badge
{

    private ?string $icon = null;
    private ?string $image = null;
    private ?string $dismissible = null;
    private array $wrapperOptions = [];

    public function __construct(
        private readonly string $label,
        private readonly string $variant = 'primary',
        private readonly ?string $size = null,
        private readonly ?string $style = null,
    ) {

        $size = $this->size ? 'badge-' . $this->size : null;
        $style = $this->style ? $this->style . '-' : null;

        $generatedClass = sprintf('badge badge-%s%s %s', $style, $this->variant, $size);
        $this->wrapperOptions = [
            'class' => trim($generatedClass),
        ];
    }

    public function wrapperOptions(array $options): self
    {
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->wrapperOptions = ArrayHelper::merge($new->wrapperOptions, $options);
        Html::addCssClass($new->wrapperOptions, $class);
        return $new;
    }

    public function render(): string
    {
        return implode('', [
            Html::openTag('span', $this->wrapperOptions),
            Html::span($this->label, ['class' => "badge-text"]),
            Html::closeTag('span'),
        ]);
    }
}
