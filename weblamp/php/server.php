#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use Lamp\Server;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(new HttpServer(new WsServer(new Server)), 8080);
$server->run();
