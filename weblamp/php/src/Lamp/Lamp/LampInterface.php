<?php
namespace Lamp\Lamp;
interface LampInterface
{
	public function morse($pin, $base_time_unit, $message);
	public function simple($pin, $on_time, $off_time, $cycles);
	public function ramp($pin, $start_on_time, $start_off_time, $end_on_time, $end_off_time, $cycles);
	public function setup($pin);
	public function toggle($pin);
	public function dot($pin, $base_time_unit, $last_in_letter);
	public function dash($pin, $base_time_unit, $last_in_letter);
	public function on($pin);
	public function off($pin);
}
?>
