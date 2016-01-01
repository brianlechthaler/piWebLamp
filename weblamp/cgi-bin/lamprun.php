<?php
function myloader($class_name)
{
	return @include_once('Lamp/'.$class_name . ".php");
}
spl_autoload_register('myloader');

$get = unserialize($argv[1]);
$lamp = new Lamp;
$lamp->get = (array) $get;
$lamp->mode = (string) $get['mode'];
$lamp->pin = (int) $get['pin'];
$lamp->morse = (boolean) $get['morse'];
$lamp->show_sleep_time = (boolean) $get['show_sleep_time'];
$lamp->verbose = (boolean) $get['verbose'];
$lamp->mode_select();
?>
