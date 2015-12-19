<?php
require 'vendor/autoload.php';
use Lamp\Gpio;
$pin_list = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27); 
$status = file_get_contents('/var/www/html/status.json');
$status = json_decode($status,  true);
while ($current_mod_time <= $status['last_mod_time']) {
	global $status, $pin_list;
	$Gpio = new Gpio;
	foreach ($pin_list as $pin) {
		if ($Gpio->isExported($pin)) {
			if($status[$pin]['1'] != $Gpio->currentDirection($pin)) {
				$status[$pin]['1'] = $Gpio->currentDirection($pin);
				file_put_contents('/var/www/html/status.json', json_encode($status));
			}
		} else {
				$status[$pin]['1'] = 'None';
				file_put_contents('var/www/html/status.json', json_encode($status));
		}
		if ($status[$pin]['2'] != $Gpio->input($pin)) {
			$status[$pin]['2'] = $Gpio->input($pin);
			file_put_contents('/var/www/html/status.json', json_encode($status));
		}
		usleep(10000);
		clearstatcache();
		$current_mod_time = filemtime('/var/www/html/status.json');
	}
}
file_put_contents('/var/www/html/status.json', json_encode($status));
echo(json_encode($status));
flush();
