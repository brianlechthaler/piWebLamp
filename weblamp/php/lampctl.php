<?php
require 'vendor/autoload.php';
function websocket() {
	$context = new ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'gpio');
    $socket->connect("tcp://localhost:5555");
    $entryData = array(
		'function'=>'gpio',
		
    );
}
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
