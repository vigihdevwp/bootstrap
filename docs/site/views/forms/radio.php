<?php

use VigihdevWP\Bootstrap\Forms\Radio;
use App\Layout\MainLayout;

$collections = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];

MainLayout::begin(title: 'Radio');

?>

<div class="col-9">
    <div class="card shadow-1">
        <div class="d-flex align-items-center p-3">
            <?php foreach ($collections as $key => $name) : ?>
                <?= (new Radio(name: "primary", label: ucfirst($name), value: $name))
                    ->render() ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="col-9 pt-4">
    <div class="card shadow-1">
        <div class="d-flex align-items-center p-3">
            <?php foreach ($collections as $key => $name) : ?>
                <?= (new Radio(name: "primary_", label: ucfirst($name), value: $name, variant: 'success'))
                    ->render() ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php MainLayout::end(); ?>