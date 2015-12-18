<?php
namespace Lamp;

class Comet implements CometInterface
{
	public 
	public function checkForUpdates($last_mod_time, $file)
	{
		usleep(10000);
		clearstatcache();
		$current_mod_time = filemtime($file);
		if ($current_mod_time <= $last_mod_time) {
			return true;
		} else {
			return false;
		}
	}
	public function response($response);
	{
		echo json_encode($response);
		flush();
	}
}
?>
