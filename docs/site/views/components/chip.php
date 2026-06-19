<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Components\Chip;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Chips');
$themeColor = new ThemeColor();

?>
<div class="col-10">
    <div class="card p-3">
        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color))->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>

        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), size: 'sm', variant: $color))->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>

        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color, style: 'outline'))
                    ->wrapperOptions(['class' => 'waves waves-effect'])
                    ->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>

        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color, size: 'sm', style: 'outline'))->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>

        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color))
                    ->wrapperOptions(['class' => 'test-wrapper'])
                    ->withDismissible(['class' => 'test-fo'])
                    ->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>
        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color))
                    ->withImage($themeColor->getAvatar($i))
                    ->withDismissible()
                    ->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>
        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color))
                    ->withImage($themeColor->getAvatar($i))
                    ->render() ?>
            <?php endforeach; ?>
        </div>

        <div class="d-block mt-4 w-100"></div>
        <div class="d-flex align-items-center gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>
                <?= (new Chip(label: ucfirst($color), variant: $color))
                    ->withIcon($themeColor->getIcon($i))
                    ->render() ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php MainLayout::end(); ?>