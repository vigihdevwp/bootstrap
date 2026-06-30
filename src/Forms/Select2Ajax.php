<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Option;

final class Select2Ajax extends AbstractFloatingLabel
{

    public function __construct(
        private readonly string $name,
        private readonly string $label,
        private readonly string $icon,
        private readonly array $items = [],
        private readonly string $variant = 'primary',
    ) {
        parent::__construct($name, $label, $icon, $variant);
    }

    public function render(): string
    {
        return implode('', [
            Html::openTag('div', $this->inputGroupOptions),
            $this->prepend(),

            Html::openTag('div', $this->wrapperOptions),
            Html::openTag('div', ['class' => 'textfield-outline-wrapper']),
            $this->label(),
            $this->selectInput(),
            Html::closeTag('div'),
            Html::closeTag('div'), // wrapperOptions

            $this->append,
            Html::closeTag('div'), // input-group
        ]);
    }

    private function selectInput(): string
    {
        return Html::select($this->name)
            ->addAttributes($this->inputOptions)
            ->addClass('form-control select2-floating-label select2-basic')
            ->id($this->id)
            ->items(...$this->option())
            ->__toString();
    }

    /**
     *
     * @return Option[]
     */
    private function option(): array
    {
        $options = [];
        foreach ($this->items as $key => $value) {
            $options[] = (new Option())->value($key)->content($value);
        }
        return $options;
    }
}
