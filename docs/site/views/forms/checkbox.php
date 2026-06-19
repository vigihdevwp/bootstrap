<?php

use VigihdevWP\Bootstrap\Forms\Checkbox;
use VigihdevWP\Bootstrap\Forms\CheckboxSwitch;
use App\Layout\MainLayout;
use App\Models\ThemeColor;
use App\Support\Partial;
use VigihdevWP\Bootstrap\Forms\CheckboxCollapse;
use VigihdevWP\Bootstrap\Forms\FloatingLabel;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Checkbox');
?>

<div class="col-9">
    <div class="card">
        <div class="d-flex align-items-center p-3">
            <?php foreach ((new ThemeColor())->list() as $key => $name) : ?>
                <?= (new Checkbox(name: $name . "{$key}", label: ucfirst($name), variant: $name))
                    ->render() ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="col-9 pt-4">
    <div class="card">
        <div class="d-flex align-items-center p-3">
            <?php foreach ((new ThemeColor())->list() as $key => $name) : ?>
                <?= (new CheckboxSwitch(name: $name . "_{$key}", label: ucfirst($name), variant: $name))
                    ->render() ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-6 pt-4">
        <div class="card shadow-1">
            <?= (new CheckboxSwitch(name: "primary_", label: 'Pesan untuk teman', variant: 'primary'))
                ->switchGroupOptions(['class' => 'p-3'])
                ->inputOptions([
                    'data-target' => 'checkbox_collapse',
                    'data-toggle' => 'checkbox-collapse'
                ])
                ->render() ?>
            <?= implode('', [
                Html::openTag('div', ['class' => 'collapse', 'id' => 'checkbox_collapse']),
                Html::openTag('div', ['class' => 'px-3 pb-3']),
                Partial::FloatingLabel(),
                Html::closeTag('div'),
                Html::closeTag('div'),
            ]) ?>
        </div>
    </div>
    <div class="col-6 pt-4">
        <div class="card shadow-1">
            <?= (new Checkbox(name: "primary__", label: 'Pesan untuk tamu', variant: 'success'))
                ->inputOptions([
                    'data-target' => 'checkbox_collapse_',
                    'data-toggle' => 'checkbox-collapse'
                ])
                ->wrapperOptions(['class' => 'p-3'])
                ->render() ?>
            <?= implode('', [
                Html::openTag('div', ['class' => 'collapse', 'id' => 'checkbox_collapse_']),
                Html::openTag('div', ['class' => 'px-3 pb-3']),
                Partial::FloatingLabel(),
                Html::closeTag('div'),
                Html::closeTag('div'),
            ]) ?>
        </div>
    </div>
</div>
<?php MainLayout::end(); ?>