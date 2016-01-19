<?php
namespace Lamp\Lamp;
require 'vendor/autoload.php';
class Lamp implements LampInterface {
	public $morse = 'false';
	public $show_sleep_time = 'false';
	public $verbose = 'false';
	protected $context;
	protected $socket;
	public function __construct() {
//		$this->context = new ZMQContext();
//		$this->socket = $this->context->getSocket(ZMQ::SOCKET_PUSH, 'status');
//		$this->socket->connect("tcp://localhost:5555");
	}
	public function morse($pin, $base_time_unit, $message) {
		$Gpio = new Gpio;
		$i=0;
		foreach ($message as $message_char) {
			$i++;
			if (array_key_exists($i, $message)) {
				$next_character=strtolower($message[$i]);
			} else {
				$next_character= false;
			}
	/*		$updateData=array(
				'function'=>'status', 
				'mode'=>'morse', 
				'character'=>strtolower($message_char), 
				'next_character'=> $next_character,
				'base_time_unit'=>$base_time_unit,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
			);
			$this->socket->send(json_encode($updateData));
	*/
			switch (strtolower($message_char)) {
				case "a":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break;
				case "b":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break;
				case "c":
						
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "d":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "e":
					$this->dot($pin, $base_time_unit, false);
					break; 
				case "f":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "g":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "h":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "i":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "j":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "k":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "l":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "m":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "n":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "o":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "p":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "q":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "r":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "s":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "t":
					$this->dash($pin, $base_time_unit, false);
					break; 
				case "u":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "v":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "w":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "x":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "y":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "z":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "1":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "2":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "3":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "4":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "5":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "6":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "7":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "8":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "9":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "0":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case ".":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit);
				
					break; 
				case ",":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "?":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "'":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "!":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "/":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "(":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case ")":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "&":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case ":":
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case ";":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "=":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "+":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "-":
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "$":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case "_":
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, true);
					break; 
				case '"':
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, true);
					break; 
				case "@":
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit, false);
					$this->dot($pin, $base_time_unit, false);
					$this->dash($pin, $base_time_unit ,false);
					$this->dot($pin, $base_time_unit, true);
					break;
				case " ";
/*					$updateData=array(
						'function'=>'status', 
						'mode'=>'sleep', 
						'morse'=>$this->morse,
						'show_sleep_time'=>$this->show_sleep_time,
						'verbose'=>$this->verbose,
						'sleep_time'=>$base_time_unit*7
					);
					$this->socket->send(json_encode($updateData));
*/
					usleep($base_time_unit*7000000);
					break;
			}
			if ($next_character != " ") {
/*				$updateData=array(
					'function'=>'status', 
					'mode'=>'sleep', 
					'morse'=>$this->morse,
					'show_sleep_time'=>$this->show_sleep_time,
					'verbose'=>$this->verbose,
					'sleep_time'=>$base_time_unit*3000000
				);
				$this->socket->send(json_encode($updateData));
*/
				usleep($base_time_unit*3000000);
			}
		}
	}
	public function simple($pin, $on_time, $off_time, $cycles) {
		$Gpio = new Gpio;
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'simple', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
		);
		$this->socket->send(json_encode($updateData));
*/
		for ($i = 1; $i <= $cycles; $i++) {
			$this->on();
/*			$updateData=array(
				'function'=>'status', 
				'mode'=>'sleep', 
				'pin'=> $pin,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
				'sleep_time'=>$on_time
			);
			$this->socket->send(json_encode($updateData));
*/
			usleep($on_time*1000000);
			$this->off($pin);
/*			$updateData=array(
				'function'=>'status', 
				'mode'=>'sleep', 
				'pin'=> $pin,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
				'sleep_time'=>$off_time
			);
			$this->socket->send(json_encode($updateData));
*/
			usleep($off_time*1000000);
		}
	}
	public function ramp($pin, $start_on_time, $start_off_time, $end_on_time, $end_off_time, $cycles) {
		$Gpio = new Gpio;
		$on_fraction = ($end_on_time - $start_on_time) / $cycles;
		$off_fraction = ($end_off_time - $start_off_time) / $cycles;
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'ramp', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
		);
		$this->socket->send(json_encode($updateData));
*/
		for ($i = 1; $i <= $cycles; $i++) {
			$on_time = $on_fraction * $i + $start_on_time;
			$off_time = $off_fraction * $i + $start_off_time;
			$this->on($pin);
/*			$updateData=array(
				'function'=>'status', 
				'mode'=>'sleep', 
				'pin'=> $pin,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
				'sleep_time'=>$on_time
				);
			$this->socket->send(json_encode($updateData));
*/
			usleep($on_time*1000000);
			$this->off($pin);
/*			$updateData=array(
				'function'=>'status', 
				'mode'=>'sleep', 
				'pin'=> $pin,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
				'sleep_time'=>$off_time
			);
			$this->socket->send(json_encode($updateData));
*/
			usleep($off_time*1000000);
		}
	}
	public function setup($pin) {
		$Gpio = new Gpio;
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'setup', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
		);
		$this->socket->send(json_encode($updateData));
*/
		$Gpio->setupPin($pin, "out");
	}
	public function toggle($pin) {
		$Gpio = new Gpio;
		$state = $Gpio->input($pin);
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'toggle', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
		);
		$this->socket->send(json_encode($updateData));
*/
		switch ($state) {
			case 0:
				$this->on($pin);
				break;
			case 1:
				$this->off($pin);
				break;
		}
	}
	public function dot($pin, $base_time_unit, $last_in_letter) {
		$Gpio = new Gpio;
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'dot', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
		);
		$this->socket->send(json_encode($updateData));
*/
		$this->on($pin);
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'sleep', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
			'sleep_time'=>$base_time_unit
		);
		$this->socket->send(json_encode($updateData));
*/
		usleep($base_time_unit*1000000);
		$this->off($pin);
		if (!$last_in_letter){
/*			$updateData=array(
				'function'=>'status', 
				'mode'=>'sleep', 
				'pin'=> $pin,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
				'sleep_time'=>$base_time_unit
			);
			$this->socket->send(json_encode($updateData));
*/			
			usleep($base_time_unit*1000000);
		}
	}
	public function dash($pin, $base_time_unit, $last_in_letter) {
		$Gpio = new Gpio;
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'dash', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
		);
		$this->socket->send(json_encode($updateData));
*/
		$this->on($pin);
/*		$updateData=array(
			'function'=>'status', 
			'mode'=>'sleep', 
			'pin'=> $pin,
			'morse'=>$this->morse,
			'show_sleep_time'=>$this->show_sleep_time,
			'verbose'=>$this->verbose,
			'sleep_time'=>$base_time_unit*3
		);
		$this->socket->send(json_encode($updateData));
*/
		usleep($base_time_unit*3000000);
		$this->off($pin);
		if (!$last_in_letter){
/*			$updateData=array(
				'function'=>'status', 
				'mode'=>'sleep', 
				'pin'=> $pin,
				'morse'=>$this->morse,
				'show_sleep_time'=>$this->show_sleep_time,
				'verbose'=>$this->verbose,
				'sleep_time'=>$base_time_unit
			);
			$this->socket->send(json_encode($updateData));
*/
			usleep($base_time_unit*1000000);
		}
	}
	public function on($pin) {
		$Gpio = new Gpio;
		$Gpio->setupPin($pin, "out");
		$Gpio->output($pin, 1);
/*		$updateData = array(
			'function'   => 'status',
			'pin'        => $pin,
			'mode'       => 'output',
			'new_value'  => 1,
		);
		$socket->send(json_encode($updateData));
*/
	}
	public function off($pin) {
		$Gpio = new Gpio;
		$Gpio->setupPin($pin, "out");
		$Gpio->output($pin, 0);
/*		$updateData = array(
			'function'   => 'status',
			'pin'        => $pin,
			'mode'       => 'output',
			'new_value'  => 0,
		);
		$socket->send(json_encode($updateData));
*/
	}
}
?>
