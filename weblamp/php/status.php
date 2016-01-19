<?php
require 'vendor/autoload.php';
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use PhpGpio\Gpio;
function readStatus(){
	$pin_list = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27);
	$Gpio = new Gpio;
	global $status;
	$status = array();
	$status = array
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
	/*foreach ($pin_list as $pin) {
		$status['pin_'.$pin] = array();
		if($Gpio->isExported($pin)) {
			$status['pin_'.$pin]['1'] = $Gpio->currentDirection($pin);
			$status['pin_'.$pin]['2'] = $Gpio->input($pin);
		} else {
			$status['pin_'.$pin]['1'] = 'None';
			$status['pin_'.$pin]['2'] = 'N/A';
		}
	}
	*/
	return $status;
	
}
function websocket() {
	global $status;
	/*if(!isset($status)) {
		$status = array
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
		readStatus();
	}*/
//	$context = new ZMQContext();
//	$socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'status');
//	$socket->connect("tcp://localhost:5555");
	//while (true) {
		//sleep(1);
		$updateData = array();
		$updateData['pin_status'] = readStatus();
		$updateData['function']='status';
		$updateData['mode']='update';
		$socket->send(json_encode($updateData));
	//	}
	}
websocket();
?>
