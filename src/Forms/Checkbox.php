<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Checkbox extends Field
{

    private string $id = '';

    private array $inputOptions = [
        'class' => 'checkbox-outline-form-control'
    ];

    private array $wrapperOptions = [
        'class' => 'checkbox-outline'

    ];

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly ?string $value = null,
        private readonly string $variant = 'primary',
        private readonly array $options = []
    ) {

        $this->id = $this->name . '-' . bin2hex(random_bytes(3));

        $this->wrapperOptions = [
            'class' => sprintf(
                $this->wrapperOptions['class'] . ' checkbox-outline-%s',
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
            Html::openTag('div', $this->wrapperOptions),
            Html::openTag('div', ['class' => 'checkbox-outline-container']),
            $this->textInput(),
            $this->svg(),
            Html::closeTag('div'), // checkbox-outline-container
            $this->label(),
            Html::closeTag('div'), // wrapperOptions
        ]);
    }

    private function textInput(): string
    {
        return Html::input('checkbox', $this->name, $this->value, $this->inputOptions)->__toString();
    }

    private function label(): string
    {
        return Html::label($this->label, $this->id)->addClass('checkbox-label')->__toString();
    }

    private function svg(): string
    {
        return implode('', [
            '<svg class="checkbox-icon checkbox-outline-checked-icon" viewBox="0 0 24 24">',
            '    <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>',
            '</svg>',
            '<svg class="checkbox-icon checkbox-outline-unchecked-icon" viewBox="0 0 24 24">',
            '    <path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>',
            '</svg>',
        ]);
    }
}
