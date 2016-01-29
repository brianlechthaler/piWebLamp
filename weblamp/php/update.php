<?php

require 'vendor/autoload.php';

use Lamp\Server;
//use Lamp\WebSocket\IoServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\ZMQ\Context;
use React\EventLoop\Factory;
use React\Socket\Server as SocketServer;
use Lamp\WebSocket\ClientRepository;
use PhpGpio\Gpio;
use Lamp\Lamp\Lamp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

$listen = socket_create(AF_UNIX, SOCK_STREAM, 0);
echo "Created socket \$listen\n";
if(false === !(socket_bind($listen, 'weblamplisten.sock'))) {
	echo "Bound socket to weblamplisten.sock\n";
} elseif(false === !connectSocket($listen, 'weblamplisten.sock')) {
	die();
}
socket_listen($listen);
echo "Set socket \$listen to listen\n";
do {
	$spawn = socket_accept($listen);
	echo "Accepted socket connection\nCreated socket\$spawn from socket \$listen\n";
	if (false === ($encodedData = socket_read($spawn, 2048, PHP_NORMAL_READ))) {
		echo "Could not read data from socket \$spawn:\n	reason: " . socket_strerror(socket_last_error($spawn)) . "\n";
		break;
	}
	if (!$encodedData = trim($encodedData)) {
		continue;
	}
	if ($encodedData == "stop\n") {
		echo "Stopping loop\n";
		break;
	}
	if ($encodedData == 'shutdown') {
		echo "Shutdown\n";
		socket_close($spawn);
		break;
	}
	echo "Read data from socket \$spawn \nData:\n	".$encodedData."\n";
	$data = json_decode($encodedData, true);
	echo "Decoded data\n";
	$output = socket_create(AF_UNIX, SOCK_STREAM, 0);
	if(false !== (connectSocket($output, 'weblampoutput.sock'))) {
		echo "Connected socket to weblampoutput.sock\n";
	}
	Lamp($output, $data);
} while(true);
function connectSocket($socket, $address){
	if(false === socket_connect($socket, $address)){
		echo "Could not connect socket " .$socket." to ".$address.": \nReason:	".socket_strerror(socket_last_error($socket))."\n";
		return false;
	} else {
		echo "Connected socket " .$socket." to ".$address."\n";
		return true;
	}
}
function Lamp($output, $data){
	$Lamp = new Lamp($output);
	$Lamp->morse = (boolean) $data['morse'];
	$Lamp->show_sleep_time = (boolean) $data['show_sleep_time'];
	$Lamp->verbose = (boolean) $data['verbose'];
	switch ($data['mode']) {
		case "morse":
			echo "Selected Morse \n";
			$Lamp->morse($data['pin'],$data['base_time_unit'],$data['message']);
			socket_write($output, "stop\n");
			break;
		case "simple":
			echo "Selected Simple \n";
			$Lamp->simple($data['pin'],$data['on_time'],$data['off_time'],$data['cycles']);
			socket_write($output, "stop\n");
			break;
		case "ramp":
			echo "Selected Ramp \n";
			$Lamp->ramp($data['pin'],$data['start_on_time'],$data['start_off_time'],$data['end_on_time'],$data['end_off_time'],$data['cycles']);
			socket_write($output, "stop\n");
			break;
		case "setup":
			echo "Selected Setup \n";
			$Lamp->setup($data['pin']);
			socket_write($output, "stop\n");
			break;
		case "on":
			echo "Selected On \n";
			$Lamp->on($data['pin']);
			socket_write($output, "stop\n");
			break;
		case "off":
			echo "Selected Off \n";
			$Lamp->off($data['pin']);
			socket_write($output, "stop\n");
			break;
		case "toggle":
			echo "Selected Toggle \n";
			$Lamp->toggle($data['pin']);
			socket_write($output, "stop\n");
			break;
		default:
			break;
	}
}
?>
