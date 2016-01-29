#!/usr/bin/env php
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

//use React\Socket\Server as SocketServer;
//use React\EventLoop\Factory;

/*$loop = Factory::create();
	$Server = new Server;
	// Listen for the web server to make a ZeroMQ push after an ajax request
//	$context = new Context($loop);
//	$pull = $context->getSocket(ZMQ::SOCKET_PULL);
//	$pull->bind('tcp://127.0.0.1:5555'); // Binding to 127.0.0.1 means the only client that can connect is itself
//	$pull->on('message', array($Server, 'onUpdate'));
	$webSock = new SocketServer($loop);
	$webSock->listen(8080, '0.0.0.0');
	*/
//declare(ticks=1);
/* pcntl_signal(SIGINT, function() {
	//socket_close($spawn);
	socket_close($connect);
	socket_close($output);
	unlink('websocketoutput.sock');
	unlink('websocketlisten.sock');
	die;
}); */
$loop = Factory::create();
	$socket = new SocketServer($loop);
	$socket->listen(8080, '0.0.0.0');
	$Server = new IoServer(
	new HttpServer(
		new WsServer(
			new Server()
		)
	),
	$socket,
	$loop
);
$Server->run();
