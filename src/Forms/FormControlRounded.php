<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class FormControlRounded extends Field
{

    private string $id = '';

    private array $inputOptions = [
        'class' => 'form-control'
    ];

    private array $inputGroupOptions = [
        'class' => 'input-group input-group-outline input-group-icon'
    ];

    private array $wrapperOptions = [
        'class' => 'form-group form-group-rounded'
    ];


    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $icon,
        private readonly string $type = 'text',
        private readonly ?string $value = null,
        private readonly string $variant = 'secondary',
        private readonly string $rounded = 'filled',
        private readonly array $options = []
    ) {

        $this->id = $this->name . '-' . bin2hex(random_bytes(3));

        $this->wrapperOptions = [
            'class' => sprintf(
                $this->wrapperOptions['class'] . ' form-group-rounded-%s form-group-rounded-%s',
                $this->variant,
                $this->rounded,
            )
        ];

        $this->inputOptions = ArrayHelper::merge($this->inputOptions, [
            'id' => $this->id,
        ]);
    }

    public function inputGroupOptions(array $options): self
    {
        $class = $this->removeClass($options);
        $this->inputGroupOptions = ArrayHelper::merge($this->addClass($this->inputGroupOptions, $class), $options);
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
            Html::openTag('div', $this->wrapperOptions),
            $this->label(),
            Html::openTag('div', $this->inputGroupOptions),
            $this->prepend(),
            $this->textInput(),
            Html::closeTag('div'), // input-group
            Html::closeTag('div'), // wrapperOptions

        ]);
    }

    private function textInput(): string
    {
        return Html::input($this->type, $this->name, $this->value, $this->inputOptions)->__toString();
    }

    private function label(): string
    {

        return Html::label($this->label, '#' . $this->id)->addClass('control-label')->__toString();
    }

    private function prepend(): string
    {
        return implode('', [
            Html::openTag('div', ['class' => 'input-group-prepend']),
            Html::openTag('div', ['class' => 'input-group-text']),
            Html::span($this->icon, ['class' => 'material-icons-outlined']),
            Html::closeTag('div'),
            Html::closeTag('div')
        ]);
    }
}
