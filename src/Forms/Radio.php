<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Radio extends Field
{

    private string $id = '';

    private array $inputOptions = [
        'class' => 'radio-input form-check-input'
    ];

    private array $wrapperOptions = [
        'class' => 'radio-root'

    ];

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly ?string $value = null,
        private readonly string $variant = 'primary',
        private readonly array $options = []
    ) {

        $name = $this->name . '-' . bin2hex(random_bytes(3));
        $this->id = preg_replace('/[^a-z-A-Z-0-9]+/', '-', $name);

        $this->wrapperOptions = [
            'class' => sprintf(
                $this->wrapperOptions['class'] . ' radio-root-%s',
                $this->variant
            )
        ];

        $this->inputOptions = ArrayHelper::merge($this->inputOptions, [
            'id' => $this->id,
        ]);
    }

    public function inputOptions(array $options): self
    {
        $class = $this->removeClass($options);
        $this->inputOptions = ArrayHelper::merge($this->addClass($this->inputOptions, $class), $options);
        return $this;
    }

    public function wrapperOptions(array $options): self
    {
        $class = $this->removeClass($options);
        $this->wrapperOptions = ArrayHelper::merge($this->addClass($this->wrapperOptions, $class), $options);
        return $this;
    }

    public function render(): string
    {
        return implode('', [
            Html::openTag('span', ['class' => 'radio-control-label']),
            Html::openTag('span', $this->wrapperOptions),

            Html::openTag('span', ['class' => 'radio-icon-label']),
            Html::openTag('span', ['class' => 'radio-icon-root']),
            $this->textInput(),
            $this->svg(),
            Html::closeTag('span'), // radio-icon-root
            Html::closeTag('span'), // radio-icon-label

            Html::span('', ['class' => 'radio-ripple-root']),
            Html::closeTag('span'), // wrapperOptions

            $this->label(),
            Html::closeTag('span'), // radio-control-label
        ]);
    }

    private function textInput(): string
    {
        return Html::input('radio', $this->name, $this->value, $this->inputOptions)->__toString();
    }

    private function label(): string
    {
        return Html::label($this->label, $this->id)->addClass('radio-label-text')->__toString();
    }

    private function svg(): string
    {
        return implode('', [
            '<svg class="svg-icon-root" width="24px" height="24px" viewBox="0 0 24 24">',
            '    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>',
            '</svg>',
            '<svg class="svg-icon-root svg-icon-root-checked" width="24px" height="24px" viewBox="0 0 24 24">',
            '    <path d="M8.465 8.465C9.37 7.56 10.62 7 12 7C14.76 7 17 9.24 17 12C17 13.38 16.44 14.63 15.535 15.535C14.63 16.44 13.38 17 12 17C9.24 17 7 14.76 7 12C7 10.62 7.56 9.37 8.465 8.465Z"/>',
            '</svg>',
        ]);
    }
}
