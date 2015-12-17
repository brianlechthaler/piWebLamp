<?php
require 'vendor/autoload.php';
use PhpGpio\Gpio;
$gpio_pin = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27);
$status = array();
	function gpio_object($pin) {
	
	}
foreach ($gpio_pin as $selected_pin) {
	$status[$selected_pin].direction = currentDirection($selected_pin);
	$status[$selected_pin].value = readValuePin($selected_pin);
}
echo ($status);
flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.26" />
</head>

<body>
	
</body>

</html>
