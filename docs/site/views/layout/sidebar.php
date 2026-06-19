<?php

use App\Support\Collapse;
use App\Support\Template;
use Yiisoft\Html\Html;

?>
<div class="sidebar-brand">
    <a href="/" class="brand-link">
        <img src="https://cdn-img.id/logo/img-3.png" alt="Brand Logo" class="brand-image">
        <!-- <img src="https://adminlte.io/themes/v4/assets/img/AdminLTELogo.png" alt="Brand Logo" class="brand-image"> -->
        <span class="brand-text">Admin Brand</span>
    </a>
</div> <!-- .sidebar-brand -->

<ul class="list-unstyled mb-0 py-3 pt-md-1">
    <li class="mb-1">
        <?= Template::collapseBtn('forms', 'Forms') ?>
        <?= (new Collapse(id: 'forms'))
            ->add('Floating Labels', '/views/forms/floating-labels.php')
            ->add('Rounded', '/views/forms/form-control-rounded.php')
            ->add('Checkbox', '/views/forms/checkbox.php')
            ->add('Radio', '/views/forms/radio.php')
            ->render(); ?>
    </li>
    <li class="mb-1">
        <?= Template::collapseBtn('components', 'Components') ?>
        <?= (new Collapse(id: 'components'))
            ->add('Alert', '/views/components/alert.php')
            ->add('Toast', '/views/components/toast.php')
            ->add('Button', '/views/components/button.php')
            ->add('Badge', '/views/components/badge.php')
            ->add('Chip', '/views/components/chip.php')
            ->add('Fab', '/views/components/fab.php')
            ->add('Modal', '/views/components/modal.php')
            ->add('Divider', '/views/components/divider.php')
            ->add('Dialog', '/views/components/dialog.php')
            ->add('Snackbar', '/views/components/snackbar.php')
            ->add('Spinner', '/views/components/spinner.php')
            ->add('Collapse', '/views/components/collapse.php')
            ->render(); ?>
    </li>
    <li class="mb-1">
        <?= Template::collapseBtn('content--', 'Contents') ?>
        <?= (new Collapse(id: 'content--'))
            ->add('Typography', '/views/contents/typography.php')
            ->render(); ?>
    </li>

</ul>