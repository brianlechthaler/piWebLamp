<?php
namespace Lamp\Websocket;
use Lamp\Lamp\Lamp;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class WebSocket implements WampServerInterface {
     protected $subscribedTopics = array();
	public function onSubscribe(ConnectionInterface $conn, $topic) {
		$this->subscribedTopics[$topic->getId()] = $topic;
	}
	public function onUpdate($data) {
		$decodedData = json_decode($data, true);
		if ($decodedData['function'] == 'status') {
			$mode = $decodedData['mode']];
			$morse = $decodedData['morse'];
			$show_sleep_time = $decodedData['show_sleep_time'];
			$verbose = $decodedData['verbose'];
			switch ($mode) {
				case "morse":
					$character = $decodedData['character'];
					$output = array(
						'mode'=>'morse', 
						'character'=>$character, 
						'morse'=>$morse,
						'show_sleep_time'=>$show_sleep_time,
						'verbose'=>$verbose
					);
					$encoded_output = json_encode($output);
					$topic->broadcast($encoded_output);
					break;
				case "simple":
					break;
				case "ramp":
					break;
				case "setup":
					$output = array(
						'mode'=>'setup', 
						'pin'=>$decodedData['pin'], 
						'verbose'=>$verbose
					);
					$topic->broadcast($encoded_output);
					break;
				case "on":
					$output = array(
						'mode'=>'on', 
						'pin'=>$decodedData['pin'], 
						'morse'=>$morse,
						'show_sleep_time'=>$show_sleep_time,
						'verbose'=>$verbose
					);
					$encoded_output = json_encode($output);
					$topic->broadcast($encoded_output);
					break;
				case "off":
					$output = array(
						'mode'=>'off', 
						'pin'=>$decodedData['pin'], 
						'morse'=>$morse,
						'show_sleep_time'=>$show_sleep_time,
						'verbose'=>$verbose
					);
					$encoded_output = json_encode($output);
					$topic->broadcast($encoded_output);
					break;
				case "toggle":
					$output = array(
						'mode'=>'toggle', 
						'pin'=>$decodedData['pin'], 
						'morse'=>$morse,
						'show_sleep_time'=>$show_sleep_time,
						'verbose'=>$verbose
					);
					$encoded_output = json_encode($output);
					$topic->broadcast($encoded_output);
					break;
				case "dot":
					$output = array(
						'mode'=>'dot', 
						'pin'=> $decodedData['pin'],
						'morse'=>$morse,
						'show_sleep_time'=>$show_sleep_time,
						'verbose'=>$verbose,
					);
					$encoded_output = json_encode($output);
					$topic->broadcast($encoded_output);
					break;
				case "dash":
					$output = array(
						'mode'=>'dash', 
						'pin'=> $decodedData['pin'],
						'morse'=>$morse,
						'show_sleep_time'=>$show_sleep_time,
						'verbose'=>$verbose,
					);
					$encoded_output = json_encode($output);
					$topic->broadcast($encoded_output);
					break;
				case "sleep":
				$output = array(
					'mode'=>'sleep', 
					'pin'=> $pin,
					'morse'=>$this->morse,
					'show_sleep_time'=>$show_sleep_time,
					'verbose'=>$verbose,
					'sleep_time'=>$decodedData['sleep_time'],
				);
				$encoded_output = json_encode($output);
				$topic->broadcast($encoded_output);
				default:
					break;
			}
		}
		if ($decodedData['function'] == 'gpio') {
			$operation = $decodedData['operation']];
			$Lamp = new Lamp;
			$Lamp->morse = (boolean) $decodedData['morse'];
			$Lamp->show_sleep_time = (boolean) $decodedData['show_sleep_time'];
			$Lamp->verbose = (boolean) $decodedData['verbose'];
			switch ($operation) {
				case "morse":
					$Lamp->morse();
					break;
				case "simple":
					$Lamp->simple();
					break;
				case "ramp":
					$Lamp->ramp();
					break;
				case "setup":
					$Lamp->setup();
					break;
				case "on":
					$Lamp->on();
					break;
				case "off":
					$Lamp->off();
					break;
				case "toggle":
					$Lamp->toggle();
					break;
				default:
					break;
			}
		}
	}
	public function onUnSubscribe(ConnectionInterface $conn, $topic) {
	}
	public function onOpen(ConnectionInterface $conn) {
	}
	public function onClose(ConnectionInterface $conn) {
	}
	public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
		// In this application if clients send data it's because the user hacked around in console
		$conn->callError($id, $topic, 'You are not allowed to make calls')->close();
	}
	public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
		// In this application if clients send data it's because the user hacked around in console
		$conn->close();
	}
	public function onError(ConnectionInterface $conn, \Exception $e) {
	}
}
?>
