<?php
require 'vendor/autoload.php';
use Lamp\Lamp;
if ('root' != exec('whoami')) {
	echo('Not running as root');
	shell_exec('sudo -u root php ./cgi-bin/lampctl.php '.escapeshellarg(serialize($_GET)));
} else {
	echo('Running as root');
	$lamp = new Lamp;
	$lamp->mode_select();
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