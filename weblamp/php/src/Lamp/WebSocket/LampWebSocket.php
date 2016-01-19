<?php
namespace Lamp\Websocket;
use Lamp\Lamp\Lamp;
use Ratchet\MessageInterface;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use React\ZMQ\Context as ZMQContext;
class LampWebSocket implements MessageComponentInterface {
	protected $clients;
	public function construct() {
        $this->clients = new \SplObjectStorage;
    }
	public function onMessage(ConnectionInterface $from, $msg) {
		$operation = $decodedData['operation'];
		$Lamp = new Lamp;
		$Lamp->morse = (boolean) $decodedData['morse'];
		$Lamp->show_sleep_time = (boolean) $decodedData['show_sleep_time'];
		$Lamp->verbose = (boolean) $decodedData['verbose'];
		switch ($operation) {
			case "morse":
				$Lamp->morse($decodedData['pin'],$decodedData['base_time_unit'],$decodedData['message']);
				break;
			case "simple":
				$Lamp->simple($decodedData['pin'],$decodedData['on_time'],$decodedData['off_time'],$decodedData['cycles']);
				break;
			case "ramp":
				$Lamp->ramp($decodedData['pin'],$decodedData['start_on_time'],$decodedData['start_off_time'],$decodedData['end_on_time'],$decodedData['end_off_time'],$decodedData['cycles']);
				break;
			case "setup":
				$Lamp->setup($decodedData['pin']);
				break;
			case "on":
				$Lamp->on($decodedData['pin']);
				break;
			case "off":
				$Lamp->off($decodedData['pin']);
				break;
			case "toggle":
				$Lamp->toggle($decodedData['pin']);
				break;
			default:
				break;
		}
	}
	 public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $querystring = $conn->WebSocket->request->getQuery();

        foreach ($querystring as $value)
        {
            if($key == "senderId")
                $senderId = $value;
        } 

        $this->clients->attach($conn, $senderId);

        echo "New connection! ({$conn->resourceId}) senderId({$senderId})\n";
    }
	public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
/*	public function onUpdate($data) {
		$decodedData = json_decode($data, true);
		$mode = $decodedData['mode'];
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
				$this->broadcast($encoded_output);
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
				$encoded_output = json_encode($output);
				$this->broadcast($encoded_output);
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
				$this->broadcast($encoded_output);
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
				$this->broadcast($encoded_output);
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
				$this->broadcast($encoded_output);
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
				$this->broadcast($encoded_output);
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
				$this->broadcast($encoded_output);
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
				$this->broadcast($encoded_output);
				break;
			case "update":
				$output = $decodedData;
				unset($output['function']);
				$encoded_output = json_encode($output);
				$this->broadcast($encoded_output);
				break;
			default:
				break;
		}
	}
	*/
}
?>
