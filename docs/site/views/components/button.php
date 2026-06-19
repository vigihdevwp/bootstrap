<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Button');

?>

<div class="col-9">
    <div class="card">
        <div class="p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= Html::button(ucfirst($color), ['class' => "btn btn-{$color} waves waves-effect"]) ?>
            <?php endforeach; ?>
            <div class="mt-4 d-block w-100"></div>

            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= Html::button(ucfirst($color), ['class' => "btn btn-sm btn-{$color}"]) ?>
            <?php endforeach; ?>
            <div class="mt-4 d-block w-100"></div>

            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= Html::button(ucfirst($color), ['class' => "btn waves waves-effect btn-outline-{$color}"]) ?>
            <?php endforeach; ?>

            <div class="mt-4 d-block w-100"></div>

            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= Html::button(ucfirst($color), ['class' => "btn btn-sm btn-outline-{$color}"]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>