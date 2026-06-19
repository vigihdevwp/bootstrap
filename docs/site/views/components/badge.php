<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Components\Badge;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Badge');
$themeColor = new ThemeColor();

?>
<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-2">
                <?php foreach ($themeColor->list() as $i => $color) : ?>
                    <?= (new Badge(label: ucfirst($color), variant: $color))->render() ?>
                <?php endforeach; ?>
            </div>

            <div class="d-block mt-4 w-100"></div>

            <div class="d-flex align-items-center gap-2">
                <?php foreach ($themeColor->list() as $i => $color) : ?>
                    <?= (new Badge(label: ucfirst($color), variant: $color))
                        ->wrapperOptions(['class' => 'rounded-pill'])
                        ->render() ?>
                <?php endforeach; ?>
            </div>

            <div class="d-block mt-4 w-100"></div>

            <div class="d-flex align-items-center gap-2">
                <?php foreach ($themeColor->list() as $i => $color) : ?>
                    <?= (new Badge(label: ucfirst($color), style: 'outline', variant: $color))->render() ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>