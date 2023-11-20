<?php

use DesignPattern\Right\Log\FileLogManager;
use DesignPattern\Right\Log\StdoutLogManager;

require "vendor/autoload.php";

$logManager = new StdoutLogManager();
$logManager->log('INFO','Testing log manager');

$logManager = new FileLogManager(__DIR__. '/log.log');
$logManager->log('INFO','Testing log manager');