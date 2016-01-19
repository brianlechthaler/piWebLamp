<?php
require 'vendor/autoload.php';
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Lamp\WebSocket\LampWebSocket;

    // Make sure you're running this as root
    $server = IoServer::factory(new HttpServer(new WsServer(new LampWebSocket)),8080);
    $server->run();
?>
