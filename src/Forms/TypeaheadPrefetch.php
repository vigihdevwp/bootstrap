<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class TypeaheadPrefetch extends AbstractFloatingLabel
{

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $icon,
        private readonly ?string $value = null,
        private readonly string $variant = 'primary',
    ) {

        parent::__construct(name: $name, label: $label, icon: $icon, value: $value, variant: $variant);
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
        $new = clone $this;
        $new->inputOptions = ArrayHelper::merge($new->inputOptions, []);
        Html::addCssClass($new->inputOptions, 'typeahead-prefetch user-select-none');
        return Html::input('text', $this->name, $this->value, $new->inputOptions)->__toString();
    }
}
