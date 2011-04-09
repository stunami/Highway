<?php

require_once(__DIR__.'/../vendor/autoload/src/Versionable/Autoload/Autoload.php');

use Versionable\Autoload\Autoload;

$al = new Autoload();
$al->registerNamespace('Versionable\Tests\Highway', __DIR__.'/../tests');
$al->registerNamespace('Versionable\Highway', __DIR__.'/../src');
$al->registerNamespace('Versionable\Prospect', __DIR__.'/../vendor/Prospect/src');
$al->register();
