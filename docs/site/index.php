<?php

use App\Layout\MainLayout;
use VigihdevWP\Bootstrap\Forms\FloatingLabel;

MainLayout::begin(title: 'Dashbord');
?>

<div class="row">
    <h2 class="px-3 w-100">Welcome Back Dashbord!</h2>
    <div class="col-md-5 mt-4">
        <div class="card p-3">
            <?= (new FloatingLabel(name: 'user', icon: 'person', label: 'User'))->render() ?>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>