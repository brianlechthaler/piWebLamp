<?php
$lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
$currentmodif = filemtime("output.txt");
while ($currentmodif <= $lastmodif) // check if the data file has been modified
{
	usleep(10000); // sleep 10ms to unload the CPU
	clearstatcache();
	$currentmodif = filemtime($filename);
}
$response = array();
$response['output'] = file_get_contents($filename);
echo json_encode($response);
flush();
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
