<?php

declare(strict_types=1);

namespace VigihdevWP\Bootstrap\Forms;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

abstract class Field
{

    public function __construct() {}

    protected function removeClass(array &$options): ?string
    {
        return ArrayHelper::remove($options, 'class');
    }

    protected function addClass(array $options, ?string $class = null): array
    {
        if (isset($options['class']) && $class) {
            $options['class'] = $options['class'] . ' ' . $class;
        }
        return $options;
    }
}
