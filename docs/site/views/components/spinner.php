<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Spinner');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="d-flex p-3">
                <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                    <?= Html::div('', ['class' => "spinner-border text-{$color} mr-3"]) ?>
                <?php endforeach; ?>
            </div>

            <div class="mt-4 d-block w-100"></div>

            <div class="d-flex p-3">
                <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                    <?= Html::div('', ['class' => "spinner-border spinner-border-sm text-{$color} mr-3"]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>