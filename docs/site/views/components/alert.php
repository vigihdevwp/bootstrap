<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Components\Alert;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Alert');
?>
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= (new Alert(message: "A simple {$color} alert—check it out!", variant: $color, withIcon: false))->render() ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-6">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= Html::div("A simple alert-solid-{$color} alert—check it out!", ['class' => "alert alert-solid-{$color}"]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-6">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->withIcon() as $color => $icon) : ?>
                <?= implode('', [
                    Html::openTag('div', ['class' => "alert alert-solid-{$color}"]),
                    Html::span($icon, ['class' => 'material-icons-outlined']),
                    Html::span("A simple alert-solid-{$color} alert—check it out!", ['class' => 'text']),
                    Html::closeTag('div')
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-6">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= Html::div("A simple alert-outline-{$color} alert—check it out!", ['class' => "alert alert-outline-{$color}"]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row mt-4">

    <div class="col-6">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->withIcon() as $color => $icon) : ?>
                <?= (new Alert(
                    message: "A simple alert-outline-{$color} alert—check it out!",
                    type: 'outline',
                    variant: $color
                ))
                    ->wrapperOptions(['class' => 'show'])->render() ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-6">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->withIcon() as $color => $icon) : ?>
                <?= (new Alert(
                    message: "A simple alert-solid-{$color} alert—check it out!",
                    dismissible: true,
                    type: 'solid',
                    variant: $color
                ))->wrapperOptions(['class' => 'show'])
                    ->render() ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>


<?php MainLayout::end(); ?>