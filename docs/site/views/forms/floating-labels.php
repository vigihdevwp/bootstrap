<?php

use App\Layout\MainLayout;
use VigihdevWP\Bootstrap\Forms\FloatingLabel;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Floating Label');
?>
<div class="col-5">
    <div class="card p-3 shadow-1">
        <?= (new FloatingLabel(name: 'email', label: 'Email', icon: 'email', type: 'email'))
            ->inputGroupOptions([])
            ->wrapperOptions([])
            ->inputOptions([])
            ->render(); ?>

        <?= (new FloatingLabel(name: 'person', label: 'Username', icon: 'person'))
            ->inputGroupOptions(['class' => 'mt-3'])
            ->render(); ?>

        <?= (new FloatingLabel(name: 'no_handphone', label: 'No Handphone', icon: 'mobile_friendly'))
            ->inputGroupOptions(['class' => 'mt-3'])
            ->render(); ?>

        <?= (new FloatingLabel(name: 'address', label: 'Address', icon: 'home'))
            ->inputGroupOptions(['class' => 'mt-3'])
            ->render(); ?>

        <?= (new FloatingLabel(name: 'password', label: 'Password', icon: 'vpn_key', type: 'password'))
            ->inputGroupOptions(['class' => 'mt-3'])
            ->inputOptions(['class' => 'password-visibility'])
            ->addAppend('visibility_off')
            ->render(); ?>

        <div class="d-flex justify-content-end mt-4">
            <?= Html::button('Submit', ['class' => 'btn btn-outline-primary']) ?>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>