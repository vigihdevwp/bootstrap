<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Fab');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <?php foreach ($themeColor->list() as $i => $color) : ?>
                    <?= implode('', [
                        Html::openTag('button', ['class' => "fab fab-{$color} mr-3"]),
                        Html::span($themeColor->getIcon($i), ['class' => 'material-icons-outlined']),
                        Html::closeTag('button'),
                    ]) ?>
                <?php endforeach; ?>
            </div>

            <div class="d-block mt-4 w-100"></div>

            <div class="d-flex align-items-center">
                <?php foreach ($themeColor->list() as $i => $color) : ?>
                    <?= implode('', [
                        Html::openTag('button', ['class' => "fab fab-sm fab-{$color} mr-3"]),
                        Html::span($themeColor->getIcon($i), ['class' => 'material-icons-outlined']),
                        Html::closeTag('button'),
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php MainLayout::end(); ?>