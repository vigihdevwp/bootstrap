<?php

use Composer\Autoload\ClassLoader;

/** @var ClassLoader $autoload  */
$autoload = require_once __DIR__ . '/../../vendor/autoload.php';

$autoload->addPsr4('App\\', __DIR__ . '/../App');
$autoload->register();
$autoload->setUseIncludePath(true);
