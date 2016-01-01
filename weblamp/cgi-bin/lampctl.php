<?php
function myloader($class_name)
{
	return @include_once('Lamp/'.$class_name . ".php");
}
spl_autoload_register('myloader');

if ('root' != exec('whoami')) {
	echo(escapeshellarg(serialize($_GET)));
	echo(exec('sudo -u root php /usr/lib/cgi-bin/lamprun.php '.escapeshellarg(serialize($_GET))));
} else {
	echo(exec('sudo -u root php /usr/lib/cgi-bin/lamprun.php '.escapeshellarg($argv[1])));
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
