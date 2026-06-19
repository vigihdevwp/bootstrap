<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use App\Support\Partial;
use VigihdevWP\Bootstrap\Components\Modal;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Modal');
$themeColor = new ThemeColor();

?>
<div class="row">
    <div class="col-6">
        <!-- Button trigger modal -->
        <?= Html::button('Launch demo modal', [
            'class' => 'btn btn-primary',
            'data-toggle' => 'modal',
            'data-target' => '#exampleModal'
        ]) ?>
        <?= Html::button('Launch demo modal sm', [
            'class' => 'btn btn-primary',
            'data-toggle' => 'modal',
            'data-target' => '#exampleModalSm'
        ]) ?>
        <?= (new Modal())
            ->withTitle('Update Profile')
            ->withBody(implode('', [
                Partial::formUpdateUser(),
            ]))
            ->withWrapperOptions(['id' => 'exampleModal'])
            ->render() ?>

        <?= (new Modal())
            ->withSize(Modal::SIZE_SMALL)
            ->withTitle('Update Profile')
            ->withBody(implode('', [
                Partial::formRadioGender(),
            ]))
            ->withWrapperOptions(['id' => 'exampleModalSm'])
            ->render() ?>
    </div>
</div>

<?php MainLayout::end(); ?>