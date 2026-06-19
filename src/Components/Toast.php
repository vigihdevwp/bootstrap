<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Json\Json;

final class Toast
{
    private ?string $close = null;
    private array $wrapperOptions = [];

    /**
     * @param string $message
     * @param int $delay
     * @param string $placement  Posisi toast (e.g., 'top-left', 'bottom-right', 'bottom-center')
     * @param string $variant   Warna theme Bootstrap (e.g., 'primary', 'success', 'danger')
     */
    public function __construct(
        private readonly string $message,
        private readonly int $delay = 3000,
        private readonly string $placement = 'top-left',
        private readonly string $variant = 'primary',
    ) {

        $generatedClass = sprintf(
            'toast toast-%s toast-%s',
            $this->variant,
            $this->placement
        );

        $this->wrapperOptions = [
            'class' => $generatedClass,
            'role' => 'alert',
            'data-animation' => 'true',
            'data-autohide' => 'true',
            'data-delay' => $this->delay,
            'aria-atomic' => 'true',
            'aria-live' => 'assertive'
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
            Html::span($this->message, ['class' => 'toast-message']),
            $this->close,
            Html::closeTag('div'),
        ]);
    }

    private function withClose(array $options = []): self
    {

        $closeOptions = ArrayHelper::merge([
            'class' => "close toast-close",
            'type' => 'button',
            'aria-label' => 'Close',
            'data-dismiss' => 'toast'
        ], $options);
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        Html::addCssClass($closeOptions, $class);

        $new->close = implode('', [
            Html::openTag('button', $closeOptions),
            Html::span('&times;', ['aria-hidden' => 'true'])->encode(false),
            Html::closeTag('button')
        ]);

        return $new;
    }

    private function item(): string
    {
        return implode('', [
            Html::openTag('div', ['class' => 'toast-custom-item']),
            Html::span($this->getIcon(), ['class' => 'material-icons-outlined toast-icons']),
            Html::span($this->message, ['class' => 'toast-message']),
            Html::closeTag('div'),
        ]);
    }

    private function getIcon(): string
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

        return isset($icons[$this->variant]) ? $icons[$this->variant] : 'info';
    }
}
