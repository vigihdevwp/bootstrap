<?php

use App\Dto\ColorDto;
use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Forms\FloatingLabel;
use VigihdevWP\Bootstrap\Forms\Select2Basic;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Json\Json;

MainLayout::begin(title: 'Select2');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-6">
        <?= (new Select2Basic(
            name: 'color',
            label: 'Color',
            icon: 'color_lens',
        ))
            ->inputGroupOptions(['class' => 'mt-3'])
            ->inputOptions([
                'data-option' => Json::encode([
                    'theme' => 'bootstrap',
                    'data' => Json::encode((new ColorDto())->seleact2Data())
                ])
            ])
            ->render(); ?>
    </div>
</div>

<?php MainLayout::end(); ?>