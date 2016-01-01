<?php
class Lamp implements LampInterface {
	public $get = array("mode"=>"none", "pin"=>"0", "morse"=>"false", "show_sleep_time"=>"false", "verbose"=>"false");
	public $mode = '';
	public $pin  = '0';
	public $morse = 'false';
	public $show_sleep_time = 'false';
	public $verbose = 'false';
	public function mode_select() {
		switch ($this->mode) {
			case "morse":
				$this->morse();
				break;
			case "simple":
				$this->simple();
				break;
			case "ramp":
				$this->ramp();
				break;
			case "setup":
				$this->setup();
				break;
			case "on":
				$this->on();
				break;
			case "off":
				$this->off();
				break;
			case "toggle":
				$this->toggle();
				break;
			default:
				die("Error no function specified");
		}
	}
	public function morse() {
		$Gpio = new Gpio;
		$base_time_unit = floatval($this->get['base_time_unit']);
		$message = str_split(strval($this->get['message']),1);
		$i=0;
		foreach ($message as $message_char) {
			switch (strtolower($message_char)) {
				case "a":
					if ($this->morse) {
						file_put_contents('output.json','<p style="margin:0px;">A</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break;
				case "b":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">B</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break;
				case "c":
						if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">C</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "d":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">D</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "e":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">E</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					break; 
				case "f":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">F</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "g":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">G</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "h":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">H</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "i":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">I</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "j":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">J</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "k":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">K</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "l":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">L</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "m":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">M</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "n":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">N</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "o":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">O</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "p":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">P</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "q":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">Q</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "r":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">R</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "s":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">S</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "t":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">T</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					break; 
				case "u":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">U</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "v":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">V</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "w":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">W</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "x":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">X</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "y":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">Y</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "z":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">Z</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "1":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">1</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "2":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">2</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "3":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">3</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "4":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">4</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "5":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">5</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "6":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">6</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "7":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">7</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "8":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">8</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "9":
					if ($this->morse) { 
						file_put_contents('output.json','<p margin:0px;>9</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "0":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">0</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case ".":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">.</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit);
				
					break; 
				case ",":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">,</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "?":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">?</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "'":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">\'</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "!":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">!</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "/":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">/</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "(":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">(</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case ")":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">)</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "&":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">&</p>', FILE_APPEND);
					}		sleep($base_time_unit*3);
	
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case ":":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">:</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case ";":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">;</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "=":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">=</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "+":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">+</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "-":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">-</p>', FILE_APPEND);
					}
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "$":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">$</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case "_":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">_</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, true);
					break; 
				case '"':
					if ($this->morse) {
						echo '"';
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, true);
					break; 
				case "@":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">@</p>', FILE_APPEND);
					}
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dash($base_time_unit, false);
					$this->dot($base_time_unit, false);
					$this->dash($base_time_unit ,false);
					$this->dot($base_time_unit, true);
					break;
				case " ":
					if ($this->morse) { 
						file_put_contents('output.json','<p style="margin:0px;">SPACE</p>', FILE_APPEND);
					}
					if ($this->morse && $show_sleep_time && $verbose) { 
						file_put_contents('output.json','<p style="margin:100px;">Sleeping '. $base_time_unit*7 .' seconds.  </p>', FILE_APPEND);
					} elseif ($this->morse && $show_sleep_time) {
						file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$base_time_unit*7 .' seconds.  </p>', FILE_APPEND);
					}
					sleep($base_time_unit*7);
					break;
			}
			$i++;
			if (array_key_exists($i, $message) && $message[$i] != " ") {
				if ($this->morse && $this->show_sleep_time && $this->verbose) { 
					file_put_contents('output.json','<p style="margin:100px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
				} elseif ($this->morse && $this->show_sleep_time) {
					file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
				}
				usleep($base_time_unit*3000000);
			}
		}
	}
	public function simple() {
		$Gpio = new Gpio;
		$on_time = floatval($this->get['on_time']);
		$off_time = floatval($this->get['off_time']);
		$cycles = intval($this->get['cycles']);
		for ($i = 1; $i <= $cycles; $i++) {
			$this->on();
			if ($this->show_sleep_time && $this->verbose) {
				file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$on_time .' seconds.  </p>', FILE_APPEND);
			}
			usleep($on_time*1000000);
			$this->off();
			if ($this->show_sleep_time && $this->verbose) {
				file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$off_time .' seconds.  </p>', FILE_APPEND);
			}
			usleep($off_time*1000000);
		}
	}
	public function ramp() {
		$Gpio = new Gpio;
		$start_on_time = floatval($this->get['start_on_time']);
		$end_on_time = floatval($this->get['end_on_time']);
		$start_off_time = floatval($this->get['start_off_time']);
		$end_off_time = floatval($this->get['end_off_time']);
		$cycles = intval($this->get['cycles']);
		$on_fraction = ($end_on_time - $start_on_time) / $cycles;
		$off_fraction = ($end_off_time - $start_off_time) / $cycles;
		for ($i = 1; $i <= $cycles; $i++) {
			$on_time = $on_fraction * $i + $start_on_time;
			$off_time = $off_fraction * $i + $start_off_time;
			$this->on();
			if ($this->show_sleep_time && $this->verbose) {
				file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$on_time.' seconds.  </p>', FILE_APPEND);
			}
			usleep($on_time*1000000);
			$this->off();
			if ($this->show_sleep_time && $this->verbose) {
				file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$off_time.' seconds.  </p>', FILE_APPEND);
			}
			usleep($off_time*1000000);
		}
	}
	public function setup() {
		$Gpio = new Gpio;
		$Gpio->setupPin($this->pin, "out");
	}
	public function toggle() {
		$Gpio = new Gpio;
		$state = $Gpio->input($this->pin);
		switch ($state) {
			case 0:
				$this->on();
				break;
			case 1:
				$this->off();
				break;
		}
	}
	public function dot($base_time_unit, $last_in_letter) {
		$Gpio = new Gpio;
		if ($this->morse) {
			file_put_contents('output.json','<p style="margin:0px;">DOT</p>', FILE_APPEND);
		}
		$this->on();
		if ($this->morse && $this->show_sleep_time && $this->verbose) { 
			file_put_contents('output.json','<p style="margin:100px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
		} elseif ($this->morse && $this->show_sleep_time) {
			file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
		}
		usleep($base_time_unit*1000000);
		$this->off();
		if ($last_in_letter != true) {
			if ($this->morse && $this->show_sleep_time && $this->verbose) { 
				file_put_contents('output.json','<p style="margin:100px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
			} elseif ($this->morse && $this->show_sleep_time) {
				file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
			}
			usleep($base_time_unit*1000000);
		}
	}
	public function dash($base_time_unit, $last_in_letter) {
		$Gpio = new Gpio;
		if ($this->morse) {
			file_put_contents('output.json','<p style="margin:0px;">DASH</p>', FILE_APPEND);
		}
		$this->on();
		if ($this->morse && $this->show_sleep_time && $this->verbose) { 
			file_put_contents('output.json','<p style="margin:100px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
		} elseif ($this->morse && $this->show_sleep_time) {
			file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
		}
		usleep($base_time_unit*3000000);
		$this->off();
		if ($last_in_letter != true) {
			if ($this->morse && $this->show_sleep_time && $this->verbose) { 
				file_put_contents('output.json','<p style="margin:100px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
			} elseif ($this->morse && $this->show_sleep_time) {
				file_put_contents('output.json','<p style="margin:50px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
			}
			usleep($base_time_unit*1000000);
		}
	}
	public function on() {
		$Gpio = new Gpio;
		$Gpio->setupPin($this->pin, "out");
		$Gpio->output($this->pin, 1);
		if ($this->verbose && $this->morse) {
			file_put_contents('output.json','<p style="margin:50px;">ON</p>', FILE_APPEND);
		} elseif ($this->verbose && $this->show_sleep_time) {
			file_put_contents('output.json','<p style="margin:0px;">ON</p>', FILE_APPEND);
		} elseif ($this->verbose){
			file_put_contents('output.json','<p style="margin:0px;">ON</p>', FILE_APPEND);
		}
	}
	public function off() {
		$Gpio = new Gpio;
		$Gpio->setupPin($this->pin, "out");
		$Gpio->output($this->pin, 0);
		if ($this->verbose && $this->morse) {
			file_put_contents('output.json','<p style="margin:50px;">OFF</p>', FILE_APPEND);
		} elseif ($this->verbose && $this->show_sleep_time) {
			file_put_contents('output.json','<p style="margin:0px;">OFF</p>', FILE_APPEND);
		} elseif ($this->verbose){
			file_put_contents('output.json','<p style="margin:0px;">OFF</p>', FILE_APPEND);
		}
	}
}
?>
