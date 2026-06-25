<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

abstract class AbstractFloatingLabel
{

    protected string $id = '';

    protected array $inputOptions = [
        'class' => 'form-control'
    ];

    protected array $inputGroupOptions = [
        'class' => 'input-group input-group-outline input-group-icon'
    ];

    protected array $wrapperOptions = [
        'class' => 'form-group textfield textfield-outline textfield-floating-label'
    ];

    protected ?string $append = null;

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $icon,
        private readonly ?string $value = null,
        private readonly string $variant = 'primary',
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
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->inputGroupOptions = ArrayHelper::merge($new->inputGroupOptions, $options);
        Html::addCssClass($new->inputGroupOptions, $class);
        return $new;
    }

    public function inputOptions(array $options): self
    {
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->inputOptions = ArrayHelper::merge($new->inputOptions, $options);
        Html::addCssClass($new->inputOptions, $class);
        return $new;
    }

    public function addAppend(string $icon, array $options = []): self
    {
        $new = clone $this;
        $new->append = $this->append($icon, $options);
        return $new;
    }

    public function wrapperOptions(array $options): self
    {
        $class = ArrayHelper::remove($options, 'class');
        $new = clone $this;
        $new->wrapperOptions = ArrayHelper::merge($new->wrapperOptions, $options);
        Html::addCssClass($new->wrapperOptions, $class);
        return $new;
    }
    protected function label(array $options = []): string
    {

        return implode('', [
            Html::openTag('div', ['class' => 'textfield-label-wrapper']),
            Html::div('', ['class' => 'textfield-outline-left']),

            Html::openTag('div', ['class' => 'textfield-outline-middle']),
            Html::label($this->label, $this->id)->addClass('control-label'),
            Html::closeTag('div'),

            Html::div('', ['class' => 'textfield-outline-right']),
            Html::closeTag('div'),
        ]);
    }

    protected function prepend(array $options = []): string
    {
        return implode('', [
            Html::openTag('div', ['class' => 'input-group-prepend']),
            Html::openTag('div', ['class' => 'input-group-text']),
            Html::span($this->icon, ['class' => 'material-icons-outlined']),
            Html::closeTag('div'),
            Html::closeTag('div')
        ]);
    }

    protected function append(string $icon, array $options = []): string
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
