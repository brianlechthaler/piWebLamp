#!/usr/bin/env php
<?php

require 'vendor/autoload.php';


$loop = React\EventLoop\Factory::create();

$webSock = new React\Socket\Server($loop);
$webSock->listen(8080, '0.0.0.0'); // Binding to 0.0.0.0 means remotes can connect
$webServer = new Ratchet\Server\IoServer(
	new Ratchet\Http\HttpServer(
		new Ratchet\WebSocket\WsServer(
			new Lamp\Server($loop)
		)
	),
	$webSock
);
$loop->run();
