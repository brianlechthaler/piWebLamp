<?php
namespace Lamp\Lamp;
interface LampInterface
{
	public function morse($pin);
	public function simple($pin);
	public function ramp($pin);
	public function setup($pin);
	public function toggle($pin);
	public function dot($base_time_unit, $last_in_letter);
	public function dash($base_time_unit, $last_in_letter);
	public function on($pin);
	public function off($pin);
}
?>
