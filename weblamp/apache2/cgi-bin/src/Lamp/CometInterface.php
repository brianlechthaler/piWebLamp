<?php
namespace Lamp;
interface CometInterface
{
	public function checkForUpdates(last_mod_time, $file);
	public function response($response);
}
?>
