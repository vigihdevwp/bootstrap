<?php

use App\Layout\MainLayout;
use App\Models\ThemeColor;
use Yiisoft\Html\Html;

MainLayout::begin(title: 'Dialog');
$themeColor = new ThemeColor();
?>
<div class="row">
    <div class="col-6">
    </div>
</div>

<?php MainLayout::end(); ?>