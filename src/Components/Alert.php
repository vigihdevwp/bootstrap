<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Alert
{

    private array $wrapperOptions = [];

    public function __construct(
        private readonly string $message,
        private readonly bool $withIcon = true,
        private readonly bool $dismissible = false,
        private readonly string $variant = 'primary',
        private readonly ?string $type = null,
        private readonly ?string $icon = null,
    ) {

        $variant = $this->type ? ' alert-' . $this->type . '-' . $this->variant : $this->variant;
        $generatedClass = sprintf('alert alert-%s', $variant);

        $this->wrapperOptions = [
            'class' => $generatedClass . ($this->dismissible ? ' alert-dismissible fade' : null),
            'role' => 'alert'
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
            Html::openTag('div', $this->wrapperOptions),
            $this->icon(),
            Html::span($this->message, ['class' => 'alert-text'])->encode(false),
            $this->dismissible(),
            Html::closeTag('div'),
        ]);
    }

    private function icon(): ?string
    {
        if ($this->withIcon) {
            $icon = Template::icon($this->variant);
            if ($this->icon) {
                $icon = $this->icon;
            }
            return Html::span($icon, ['class' => 'material-icons-outlined alert-icons'])->__toString();
        }
        return null;
    }

    private function dismissible(): ?string
    {
        if (!$this->dismissible) return null;
        return implode('', [
            Html::openTag('button', [
                'class' => 'close',
                'data-dismiss' => 'alert',
                'aria-label' => 'Close'
            ]),
            Html::span('&times;', ['aria-hidden' => 'true'])->encode(false),
            Html::closeTag('button'),
        ]);
    }
}
