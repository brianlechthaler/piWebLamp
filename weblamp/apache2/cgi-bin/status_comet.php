<?php
require 'vendor/autoload.php';
use Lamp\Comet;
use Lamp\Gpio;
$Comet = new Comet;
$GPIO = new Gpio;
$pin_list = $GPIO->getHackablePins();
while (!($Comet->checkForUpdates('status.txt'))) {
	$status = array();
	foreach ($pin_list as $pin){
		file_put_contents('status.txt',"");
		if ($GPIO->isExported) {
			$status[$pin].direction = $GPIO->currentDirection($pin));
		} else {
			$status[$pin].direction = 'None';
		}
		$status[$pin].value = $GPIO->input($pin);
		file_put_contents('status.txt', $pin.','.$status[$pin].value .','.$status[$pin].value .'/n', FILE_APPEND);
	}
}
$Comet->response($status);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.26" />
</head>

<body>
	
</body>

</html>
