<?php
require 'vendor/autoload.php';
use Lamp\Gpio;
$pin_list = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27); 
$status = array
(
	'last_mod_time'=>filemtime('../../../var/www/html/status.json'),
	'2' =>array('2' ,'none','0'),
	'3' =>array('3' ,'none','0'),
	'4' =>array('4' ,'none','0'),
	'7' =>array('7' ,'none','0'),
	'8' =>array('8' ,'none','0'),
	'9' =>array('9' ,'none','0'),
	'10'=>array('10','none','0'),
	'11'=>array('11','none','0'),
	'14'=>array('14','none','0'),
	'15'=>array('15','none','0'),
	'17'=>array('17','none','0'),
	'18'=>array('18','none','0'),
	'22'=>array('22','none','0'),
	'23'=>array('23','none','0'),
	'24'=>array('24','none','0'),
	'25'=>array('25','none','0'),
	'27'=>array('27','none','0')
);
while ($current_mod_time <= $status['last_mod_time']) {
	global $status, $pin_list;
	$Gpio = new Gpio;
	foreach ($pin_list as $pin){
		if ($Gpio->isExported($pin)) {
			$status[$pin]['1'] = $Gpio->currentDirection($pin);
		} else {
			$status[$pin]['1'] = 'None';
		}
		$status[$pin]['2'] = $Gpio->input($pin);
	}
	usleep(10000);
	clearstatcache();
	$current_mod_time = filemtime('../../../var/www/html/status.json');
}
echo(json_encode($status));
flush();
