#!/usr/bin/env php
<?php
require_once '../vendor/autoload.php';

use SmartHawk\Commands\CorrectorCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new CorrectorCommand());
$app -> run();