<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Json\Json;

final class TypeaheadAjax extends AbstractFloatingLabel
{

    private array $dataOptions = [];

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $icon,
        private readonly string $remoteUrl,
        private readonly string $remoteName,
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
        $new->inputOptions = ArrayHelper::merge($new->inputOptions, [
            'data-options' => Json::encode([
                'remoteUrl' => $this->remoteUrl,
                'name' => $this->remoteName,
                'options' => $this->dataOptions
            ]),
        ]);
        Html::addCssClass($new->inputOptions, 'typeahead-ajax user-select-none');
        return Html::input('text', $this->name, $this->value, $new->inputOptions)->__toString();
    }

    public function dataOptions(
        bool $highlight = true,
        bool $hint = true,
        int $minLength = 1,
        ?string $classNames = null,
        array $options = []
    ): self {

        $dataOptions = ArrayHelper::merge($options, [
            'highlight' => $highlight,
            'hint' => $hint,
            'minLength' => $minLength,
            'classNames' => $classNames,
        ]);

        $dataOptions = array_filter($dataOptions, fn($value) => $value !== null);

        $new = clone $this;
        $new->dataOptions = $dataOptions;

        return $new;
    }
}
