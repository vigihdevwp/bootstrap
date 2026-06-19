<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class FloatingLabel extends Field
{

    private string $id = '';

    private array $inputOptions = [
        'class' => 'form-control'
    ];

    private array $inputGroupOptions = [
        'class' => 'input-group input-group-outline input-group-icon'
    ];

    private array $wrapperOptions = [
        'class' => 'form-group textfield textfield-outline textfield-floating-label'
    ];

    private ?string $append = null;

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $icon,
        private readonly string $type = 'text',
        private readonly ?string $value = null,
        private readonly string $variant = 'secondary',
        private readonly array $options = []
    ) {

        $this->id = $this->name . '-' . bin2hex(random_bytes(3));

        $this->wrapperOptions = [
            'class' => sprintf(
                $this->wrapperOptions['class'] . ' textfield-%s',
                $this->variant
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

    public function addAppend(string $icon, array $options = []): self
    {
        $this->append = $this->append($icon, $options);
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
            Html::openTag('div', $this->inputGroupOptions),
            $this->prepend(),

            Html::openTag('div', $this->wrapperOptions),
            Html::openTag('div', ['class' => 'textfield-outline-wrapper']),
            $this->label(),
            $this->textInput(),
            Html::closeTag('div'),
            Html::closeTag('div'), // wrapperOptions

            $this->append,
            Html::closeTag('div'), // input-group
        ]);
    }

    private function textInput(): string
    {
        $options = $this->inputOptions;
        $class = ArrayHelper::remove($options, 'class');
        $class = $class ? ' ' . $class : null;

        return Html::input($this->type, $this->name, $this->value, $this->inputOptions)->__toString();
    }

    private function label(): string
    {

        return implode('', [
            Html::openTag('div', ['class' => 'textfield-label-wrapper']),
            Html::div('', ['class' => 'textfield-outline-left']),

            Html::openTag('div', ['class' => 'textfield-outline-middle']),
            Html::label($this->label, '#' . $this->id)->addClass('control-label'),
            Html::closeTag('div'),

            Html::div('', ['class' => 'textfield-outline-right']),
            Html::closeTag('div'),
        ]);
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

    private function append(string $icon, array $options = []): string
    {
        return implode('', [
            Html::openTag('div', ['class' => 'input-group-append']),
            Html::openTag('div', ['class' => 'input-group-text']),
            Html::span($icon, ['class' => 'material-icons-outlined']),
            Html::closeTag('div'),
            Html::closeTag('div')
        ]);
    }
}
