<?php
require 'vendor/autoload.php';
use Lamp\Lamp;
$get = unserialize($argv[1]);
$lamp = new Lamp;
$lamp->get = $get;
$lamp->mode = $get['mode'];
$lamp->pin = $get['pin'];
$lamp->morse = $get['morse'];
$lamp->show_sleep_time = $get['show_sleep_time'];
$lamp->verbose = $get['verbose'];
$lamp->mode_select();
?>
