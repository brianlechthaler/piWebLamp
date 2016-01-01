<?php
function myloader($class_name)
{
	include('Lamp/'.$class_name . '.php');
}
spl_autoload_register('myloader');
session_name('status');
if(session_start()) {
	$_SESSION['pin_list'] = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 7, 18, 22, 23, 24, 25, 27); 
	$_SESSION['status'] = array
	(
		'pin_2' =>array('pin_2' ,'None','N/A'),
		'pin_3' =>array('pin_3' ,'None','N/A'),
		'pin_4' =>array('pin_4' ,'None','N/A'),
		'pin_7' =>array('pin_7' ,'None','N/A'),
		'pin_8' =>array('pin_8' ,'None','N/A'),
		'pin_9' =>array('pin_9' ,'None','N/A'),
		'pin_10'=>array('pin_10','None','N/A'),
		'pin_11'=>array('pin_11','None','N/A'),
		'pin_14'=>array('pin_14','None','N/A'),
		'pin_15'=>array('pin_15','None','N/A'),
		'pin_17'=>array('pin_17','None','N/A'),
		'pin_18'=>array('pin_18','None','N/A'),
		'pin_22'=>array('pin_22','None','N/A'),
		'pin_23'=>array('pin_23','None','N/A'),
		'pin_24'=>array('pin_24','None','N/A'),
		'pin_25'=>array('pin_25','None','N/A'),
		'pin_27'=>array('pin_27','None','N/A')
	);
}
$status = $_SESSION['status'];
while (true) {
	global $status;
	$status = array();
	$Gpio = new Gpio;
	foreach ($_SESSION['pin_list'] as $pin) {
		$status['pin_'.$pin] = array();
		if($Gpio->isExported($pin)) {
			$status['pin_'.$pin]['1'] = $Gpio->currentDirection($pin);
			$status['pin_'.$pin]['2'] = $Gpio->input($pin);
		} else {
			$status['pin_'.$pin]['1'] = 'None';
			$status['pin_'.$pin]['2'] = 'N/A';
		}
	}
	usleep(50);
	clearstatcache();
	if($_SESSION['status'] != $status) {
		break;
	}
}
echo(json_encode($status));
flush();

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
