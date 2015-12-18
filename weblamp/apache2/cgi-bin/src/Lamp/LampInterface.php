<?php

namespace Lamp;
interface LampInterface
{
	const output_file = 'output';
	public function mode_select();
	public function morse();
	public function simple();
	public function ramp();
	public function setup();
	public function toggle();
	public function dot($base_time_unit, $last_in_letter);
	public function dash($base_time_unit, $last_in_letter);
	public function on();
	public function off();
}
