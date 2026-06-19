<?php

use App\Layout\MainLayout;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Typography');
?>
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <h1>h1. Bootstrap heading</h1>
            <h2>h2. Bootstrap heading</h2>
            <h3>h3. Bootstrap heading</h3>
            <h4>h4. Bootstrap heading</h4>
            <h5>h5. Bootstrap heading</h5>
            <h6>h6. Bootstrap heading</h6>

        </div>
    </div>
</div>

<?php MainLayout::end(); ?>