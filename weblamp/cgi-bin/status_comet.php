<?php
function myloader($class_name)
{
	include('Lamp/'.$class_name . '.php');
}
function readStatus(){
	$pin_list = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 7, 18, 22, 23, 24, 25, 27);
	global $status;
	$status = array();
	$Gpio = new Gpio;
	foreach ($pin_list as $pin) {
		$status['pin_'.$pin] = array();
		if($Gpio->isExported($pin)) {
			$status['pin_'.$pin]['1'] = $Gpio->currentDirection($pin);
			$status['pin_'.$pin]['2'] = $Gpio->input($pin);
		} else {
			$status['pin_'.$pin]['1'] = 'None';
			$status['pin_'.$pin]['2'] = 'N/A';
		}
	}
}
function comet() {
	if(!array_key_exists('status', $_SESSION)) {
		$_SESSION['status'] = array
		(
			'pin_2' =>array('None','N/A'),
			'pin_3' =>array('None','N/A'),
			'pin_4' =>array('None','N/A'),
			'pin_7' =>array('None','N/A'),
			'pin_8' =>array('None','N/A'),
			'pin_9' =>array('None','N/A'),
			'pin_10'=>array('None','N/A'),
			'pin_11'=>array('None','N/A'),
			'pin_14'=>array('None','N/A'),
			'pin_15'=>array('None','N/A'),
			'pin_17'=>array('None','N/A'),
			'pin_18'=>array('None','N/A'),
			'pin_22'=>array('None','N/A'),
			'pin_23'=>array('None','N/A'),
			'pin_24'=>array('None','N/A'),
			'pin_25'=>array('None','N/A'),
			'pin_27'=>array('None','N/A')
		);
	}
	while (true) {
		global $status;
		readStatus();
		usleep(50);
		if($_SESSION['status'] = $status) {
			break;
		}
	}
	$_SESSION['status'] = $status;
	header("content-type:application/json");
	echo(json_encode($status));
	flush();
}spl_autoload_register('myloader');
session_name('status');
session_start(); 
comet();
