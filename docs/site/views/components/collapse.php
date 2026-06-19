<?php

use App\Layout\MainLayout;
use VigihdevWP\Bootstrap\Components\Collapse;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Collapse');

?>
<div class="row">
    <div class="col-md-6">
        <?= (new Collapse(targetId: 'collapse_1', label: 'Collapse One'))
            ->toggleOptions(['class' => 'd-flex'])
            ->content(implode('', [
                Html::span('Hallo Word Collapse One', ['class' => 'text-content']),
                Html::div('Hallo Word Collapse One 2', ['class' => 'text-content']),
            ]))
            ->render() ?>
    </div>
</div>

<?php MainLayout::end(); ?>