<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Components;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Modal
{
    // Konstanta Ukuran Modal
    public const SIZE_LARGE = 'modal-lg';
    public const SIZE_SMALL = 'modal-sm';
    public const SIZE_XLARGE = 'modal-xl';
    public const SIZE_DEFAULT = '';

    // Properti internal untuk menampung konten & opsi
    private string $title = '';
    private string $body = '';
    private string $footer = '';
    private string $size = self::SIZE_DEFAULT;

    private array $wrapperOptions = [
        'class' => 'modal fade',
        'tabindex' => '-1',
        'aria-hidden' => 'true',
    ];

    private array $dialogOptions = [
        'class' => 'modal-dialog',
    ];

    public function __construct(array $options = [])
    {
        $this->wrapperOptions = ArrayHelper::merge($this->wrapperOptions, $options);
    }

    public function withTitle(string $title): self
    {
        $new = clone $this;
        $new->title = $title;
        return $new;
    }

    public function withBody(string $body): self
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }

    public function withFooter(string $footer): self
    {
        $new = clone $this;
        $new->footer = $footer;
        return $new;
    }

    public function withSize(string $size): self
    {
        $new = clone $this;
        $new->size = $size;
        return $new;
    }

    public function withWrapperOptions(array $options): self
    {
        $new = clone $this;
        $new->wrapperOptions = ArrayHelper::merge($new->wrapperOptions, $options);
        return $new;
    }

    public function render(): string
    {
        $dialogOptions = $this->dialogOptions;
        if ($this->size !== self::SIZE_DEFAULT) {
            Html::addCssClass($dialogOptions, $this->size);
        }

        return implode('', [
            Html::openTag('div', $this->wrapperOptions),
            Html::openTag('div', $dialogOptions),
            Html::openTag('div', ['class' => 'modal-content']),

            $this->renderHeader(),
            $this->renderBody(),
            $this->renderFooter(),

            Html::closeTag('div'), // modal-content
            Html::closeTag('div'), // modal-dialog
            Html::closeTag('div'), // modal-wrapper
        ]);
    }

    private function renderHeader(): string
    {
        if ($this->title === '') {
            return '';
        }

        return implode('', [
            Html::openTag('div', ['class' => 'modal-header']),
            Html::tag('h3', $this->title, ['class' => 'modal-title']),

            Html::openTag('button', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-label' => 'Close']),
            Html::span('&times;', ['aria-hidden' => 'true'])->encode(false),
            Html::closeTag('button'),

            Html::closeTag('div')
        ]);
    }

    private function renderBody(): string
    {
        if ($this->body === '') {
            return '';
        }

        return Html::div($this->body, ['class' => 'modal-body'])->encode(false)->__toString();
    }

    private function renderFooter(): string
    {
        if ($this->footer === '') {
            return '';
        }

        return Html::div($this->footer, ['class' => 'modal-footer'])->encode(false)->__toString();
    }
}
