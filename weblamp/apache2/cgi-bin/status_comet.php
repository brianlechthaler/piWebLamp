<?php
require 'vendor/autoload.php';
use Lamp\Comet;
use Lamp\Gpio;
$Comet = new Comet;
$GPIO = new Gpio;
while (!($Comet->checkForUpdates('status.json'))) {
	$pin_list=array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27);
	$status = array
	(
		array('2','none','0'),
		array('3','none','0'),
		array('4','none','0'),
		array('7','none','0'),
		array('8','none','0'),
		array('9','none','0'),
		array('10','none','0'),
		array('11','none','0'),
		array('14','none','0'),
		array('15','none','0'),
		array('17','none','0'),
		array('18','none','0'),
		array('22','none','0'),
		array('23','none','0'),
		array('24','none','0'),
		array('25','none','0'),
		array('27','none','0')
	);
	foreach ($pin_list as $pin){
		if ($GPIO->isExported) {
			$status[$pin][1] = $GPIO->currentDirection($pin);
		} else {
			$status[$pin][1] = 'None';
		}
		$status[$pin][2] = $GPIO->input($pin);
		file_put_contents('status.json',json_encode($status));
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
