<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Snackbar
{

    private array $wrapperOptions = [];

    public function __construct(
        private readonly string $message,
        private readonly int $delay = 5000,
        private readonly string $placement = 'bottom-left',
        private readonly string $variant = 'dark',
        private readonly ?string $icon = null,
    ) {

        $generatedClass = sprintf('snackbar fade snackbar-%s', $this->variant);
        $this->wrapperOptions = [
            'class' => $generatedClass,
            'data-delay' => $this->delay,
            'data-placement' => $this->placement
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
        $icon = Template::icon($this->variant);
        if ($this->icon) {
            $icon = $this->icon;
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            Html::span($icon, ['class' => 'material-icons-outlined snackbar-icons']),
            Html::span($this->message, ['class' => 'snackbar-text'])->encode(false),
            Html::closeTag('div'),
        ]);
    }
}
