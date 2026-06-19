<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Components\Toast;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Toast');
$themeColor = new ThemeColor();
?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex flex-wrap gap-2">
            <?php foreach ($themeColor->list() as $i => $color) : ?>

                <?= (new Toast(
                    message: "Hello, world! This is a toast message.",
                    variant: $color
                ))->wrapperOptions(['class' => 'fade show'])
                    ->render() ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<div class="p-3 d-flex gap-2">
    <div class="d-flex gap-2 mt-3">
        <?= Html::button('Show live toast left', ['class' => 'btn btn-toast btn-primary', 'data-target' => '#toast-bottom-left']) ?>
        <?= Html::button('Show live toast center', ['class' => 'btn btn-toast btn-primary', 'data-target' => '#toast-bottom-center']) ?>
        <?= Html::button('Show live toast right', ['class' => 'btn btn-toast btn-primary', 'data-target' => '#toast-bottom-right']) ?>
    </div>

    <?= (new Toast(
        message: "Hello, world! This is a toast message.",
        delay: 5000,
        variant: 'secondary',
        placement: 'bottom-left'
    ))
        ->wrapperOptions(['id' => 'toast-bottom-left', 'class' => 'hide'])
        ->render() ?>

    <?= (new Toast(
        message: "Hello, world! This is a toast message.",
        delay: 5000,
        variant: 'secondary',
        placement: 'bottom-center'
    ))
        ->wrapperOptions(['id' => 'toast-bottom-center', 'class' => 'hide'])
        ->render() ?>

    <?= (new Toast(
        message: "Hello, world! This is a toast message.",
        delay: 5000,
        variant: 'success',
        placement: 'bottom-right'
    ))
        ->wrapperOptions(['id' => 'toast-bottom-right', 'class' => 'hide'])
        ->render() ?>
</div>


<?php MainLayout::registerJs(); ?>
<script>
    (function($) {
        "use strict";
        $(document).ready(() => {
            $('button.btn-toast').on('click', (event) => {
                event.preventDefault()
                const id = $(event.target).data('target')
                if (!id || $(`${id}`).length === 0) return;
                const $element = $(`${id}`).toast('show')
            })
        });
    })(jQuery);
</script>

<?php MainLayout::end(); ?>