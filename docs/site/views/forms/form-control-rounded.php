<?php

use App\Layout\MainLayout;
use VigihdevWP\Bootstrap\Forms\FormControlRounded;

MainLayout::begin(title: 'Form Control Rounded');
?>

<div class="col-9">
    <div class="card">
        <div class="d-flex align-items-center p-3">
            <?= (new FormControlRounded(name: 'email', label: 'Email', icon: 'email', type: 'email'))
                ->inputGroupOptions(['class' => 'mb-3'])
                ->wrapperOptions([])
                ->inputOptions([])
                ->render(); ?>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>