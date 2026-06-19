<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Components\Snackbar;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Snackbar');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= implode('', [
                    Html::openTag('div', ['class' => "snackbar snackbar-{$color} mb-3"]),
                    Html::span('Profile berhasil di update', ['class' => 'snackbar-text']),
                    Html::closeTag('div')
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= implode('', [
                    Html::openTag('div', ['class' => "snackbar snackbar-{$color} mb-3"]),
                    Html::span($themeColor->getIcon($i), ['class' => 'material-icons-outlined snackbar-icons']),
                    Html::span('Profile berhasil di update', ['class' => 'snackbar-text']),
                    Html::closeTag('div')
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <?php foreach ((new ThemeColor())->list() as $i => $color) : ?>
                <?= implode('', [
                    Html::openTag('div', ['class' => "snackbar snackbar-{$color} mb-3"]),
                    Html::span($themeColor->getIcon($i), ['class' => 'material-icons-outlined snackbar-icons']),
                    Html::span(implode('', [
                        'Profile berhasil di update ',
                        Html::a('undo', '#', ['class' => 'snackbar-link'])
                    ]), ['class' => 'snackbar-text'])->encode(false),
                    Html::closeTag('div')
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex gap-2 mt-3">
            <?= Html::button('Show live snackbar left', ['class' => 'btn btn-snackbar btn-primary', 'data-target' => '#snackbar-left']) ?>
            <?= Html::button('Show live snackbar center', ['class' => 'btn btn-snackbar btn-primary', 'data-target' => '#snackbar-center']) ?>
            <?= Html::button('Show live snackbar right', ['class' => 'btn btn-snackbar btn-primary', 'data-target' => '#snackbar-right']) ?>
        </div>

        <?= (new Snackbar(message: 'Profile berhasil di update'))
            ->wrapperOptions(['id' => 'snackbar-left'])
            ->render() ?>

        <?= (new Snackbar(message: 'Profile berhasil di update', placement: 'bottom-center'))
            ->wrapperOptions(['id' => 'snackbar-center'])
            ->render() ?>

        <?= (new Snackbar(message: 'Profile berhasil di update', placement: 'bottom-right', variant: 'success', icon: 'celebration'))
            ->wrapperOptions(['id' => 'snackbar-right', 'class' => 'show'])
            ->render() ?>

    </div>
</div>

<?php MainLayout::registerJs(); ?>
<script>
    (function($) {
        "use strict";
        $(document).ready(() => {
            const Model = window?.app?.Snackbar;
            if (!Model) return;
            $('button.btn-snackbar').on('click', (event) => {
                event.preventDefault()
                const id = $(event.target).data('target')
                if (!id || $(`${id}`).length === 0) return;
                const snackbar = new Model(`${id}`)
                snackbar.show()
            })
        });
    })(jQuery);
</script>
<?php MainLayout::end(); ?>