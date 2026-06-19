<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Chip
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

        $size = $this->size ? 'chip-' . $this->size : null;
        $style = $this->style ? $this->style . '-' : null;

        $generatedClass = sprintf('chip chip-%s%s %s', $style, $this->variant, $size);
        $this->wrapperOptions = [
            'class' => trim($generatedClass),
            'role' => 'chip'
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

    public function withDismissible(array $options = []): self
    {
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->dismissible = Html::span('clear', ArrayHelper::merge([
            'class' => "material-icons-outlined chip-close",
            'type' => 'button',
            'aria-label' => 'Close',
            'data-dismiss' => 'chip'
        ], $options))
            ->addClass($class)->__toString();
        return $new;
    }

    public function withIcon(string $name, array $options = []): self
    {
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->icon = Html::span($name, ArrayHelper::merge(['class' => "material-icons-outlined chip-icons"], $options))
            ->addClass($class)->__toString();
        return $new;
    }

    public function withImage(string $url, array $options = []): self
    {
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->image = Html::img($url, 'image', ArrayHelper::merge(['class' => "chip-image"], $options))
            ->addClass($class)->__toString();
        return $new;
    }

    public function render(): string
    {
        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            $this->icon,
            $this->image,
            Html::span($this->label, ['class' => "chip-text"]),
            $this->dismissible,
            Html::closeTag('div'),
        ]);
    }
}
