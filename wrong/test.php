<?php

use DesignPattern\Wrong\Log\LogManager;

require "vendor/autoload.php";

$logManager = new LogManager();
$logManager->log('INFO','Testing log manager');