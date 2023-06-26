<?php
use Noodlehaus\Config;

// include initialize
require_once 'init.php';

$GLOBALS['config'] = Config::load(__DIR__ . DIRECTORY_SEPARATOR . file_get_contents(dirname(__DIR__) . '/mode.php') . '.php');
$config = $GLOBALS['config'];
