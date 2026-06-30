<?php

use App\Dto\ColorDto;
use App\Layout\MainLayout;
use App\Models\ThemeColor;
use VigihdevWP\Bootstrap\Forms\FloatingLabel;
use VigihdevWP\Bootstrap\Forms\TypeaheadAjax;
use VigihdevWP\Bootstrap\Forms\TypeaheadBasic;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Typeahead');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-md-6">
        <div class="card p-3">
            <?= (new FloatingLabel(name: 'person', label: 'Username', icon: 'person'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <?= (new FloatingLabel(name: 'email', label: 'Email', icon: 'email', type: 'email'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <?= (new FloatingLabel(name: 'no_handphone', label: 'No Handphone', icon: 'mobile_friendly'))
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <?= (new TypeaheadBasic(
                name: 'typeahead_basic',
                label: 'Basic',
                icon: 'games',
                data: (new ColorDto())->lists()
            ))
                ->dataOptions()
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

            <?= (new TypeaheadAjax(
                name: 'countries_ajax',
                label: 'Countries',
                icon: 'games',
                remoteUrl: 'https://raw.githubusercontent.com/twitter/typeahead.js/refs/heads/gh-pages/data/countries.json',
                remoteName: 'countries'
            ))
                ->dataOptions()
                ->inputGroupOptions(['class' => 'mt-3'])
                ->render(); ?>

        </div>
    </div>
</div>

<?php MainLayout::end(); ?>