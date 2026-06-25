<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Owl Carousel');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-md-7">
        <div class="owl-flex">
            <?= Html::img('https://cdn-img.id/slider/img-1.webp', 'alt', ['class' => 'item-img img-fluid']) ?>

            <?= Html::img('https://cdn-img.id/slider/img-2.webp', 'alt', ['class' => 'item-img img-fluid']) ?>
            <?= Html::img('https://cdn-img.id/slider/img-3.webp', 'alt', ['class' => 'item-img img-fluid']) ?>
            <?= Html::img('https://cdn-img.id/slider/img-4.webp', 'alt', ['class' => 'item-img img-fluid']) ?>
            <?= Html::img('https://cdn-img.id/slider/img-5.webp', 'alt', ['class' => 'item-img img-fluid']) ?>
            <?= Html::img('https://cdn-img.id/slider/img-6.webp', 'alt', ['class' => 'item-img img-fluid']) ?>
        </div>
    </div>
    <div class="col-md-5">
    </div>
</div>


<?php MainLayout::registerJs(); ?>
<script>
    (function($) {
        "use strict";
        $(document).ready(() => {
            setTimeout(() => {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    // nav: true,
                    dots: false,
                    items: 2
                })
            }, 1000)
        });
    })(jQuery);
</script>

<?php MainLayout::end(); ?>