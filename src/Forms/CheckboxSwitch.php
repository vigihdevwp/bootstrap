<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class CheckboxSwitch extends Field
{

    private string $id = '';

    private array $inputOptions = [
        'class' => 'checkbox-switch-form-control'
    ];

    private array $wrapperOptions = [
        'class' => 'checkbox-switch'

    ];

    private array $switchGroupOptions = [
        'class' => 'checkbox-switch-group cursor-pointer select-none'
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
                $this->wrapperOptions['class'] . ' checkbox-switch-%s',
                $this->variant
            )
        ];

        $this->inputOptions = ArrayHelper::merge($this->inputOptions, [
            'id' => $this->id,
        ]);
    }

    public function switchGroupOptions(array $options): self
    {
        $class = $this->removeClass($options);
        $this->switchGroupOptions = ArrayHelper::merge($this->addClass($this->switchGroupOptions, $class), $options);
        return $this;
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
            Html::openTag('div', $this->switchGroupOptions),
            Html::openTag('div', $this->wrapperOptions),
            Html::openTag('div', ['class' => 'checkbox-switch-container']),
            $this->textInput(),
            Html::span('', ['class' => 'switch-thumb']),
            Html::span('', ['class' => 'switch-thumb-ripple']),
            Html::closeTag('div'), // checkbox-outline-container
            Html::span('', ['class' => 'checkbox-switch-track']),
            Html::closeTag('div'), // wrapperOptions
            $this->label(),
            Html::closeTag('div'), // checkbox-switch-group
        ]);
    }

    private function textInput(): string
    {
        return implode('', [
            Html::hiddenInput($this->name, '0')->__toString(),
            Html::input('checkbox', $this->name, $this->value, $this->inputOptions)->__toString()
        ]);
    }

    private function label(): string
    {
        return Html::label($this->label, $this->id)->addClass('checkbox-switch-label')->__toString();
    }
}
