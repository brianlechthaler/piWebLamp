<?php
require_once 'src/autoload.php';
use PhpGpio\Gpio;
$mode = $_GET['mode'];
switch ($mode) {
	case "morse":
		morse();
		break;
	case "simple":
		simple();
		break;
	case "ramp":
		ramp();
		break;
	case "setup":
		setup();
		break;
	case "on":
		on_function();
		break;
	case "off":
		off_function();
		break;
	case "toggle":
		toggle();
		break;
}
function morse() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	$base_time_unit = $_GET['base_time_unit'];
	$message = str_split($_GET['message'],1);
	$i=1;
	foreach ($message as $message_char) {
		switch (strtolower($message_char)) {
			case "a":
				if ($morse) {
					file_put_contents(output,'<p style="margin:0px;">A</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break;
			case "b":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">B</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break;
			case "c":
					if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">C</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "d":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">D</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "e":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">E</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				break; 
			case "f":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">F</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "g":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">G</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "h":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">H</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "i":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">I</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "j":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">J</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "k":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">K</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "l":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">L</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "m":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">M</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "n":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">N</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "o":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">O</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "p":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">P</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "q":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">Q</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "r":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">R</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "s":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">S</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "t":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">T</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				break; 
			case "u":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">U</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "v":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">V</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "w":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">W</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "x":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">X</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "y":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">Y</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "z":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">Z</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "1":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">1</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "2":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">2</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "3":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">3</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "4":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">4</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "5":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">5</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "6":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">6</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "7":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">7</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "8":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">8</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "9":
				if ($morse) { 
					file_put_contents(output,'<p margin:0px;>9</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "0":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">0</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case ".":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">.</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit);
			
				break; 
			case ",":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">,</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "?":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">?</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "'":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">\'</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "!":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">!</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "/":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">/</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "(":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">(</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case ")":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">)</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "&":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">&</p>', FILE_APPEND);
				}		sleep($base_time_unit*3);

				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case ":":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">:</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case ";":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">;</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "=":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">=</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "+":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">+</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "-":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">-</p>', FILE_APPEND);
				}
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "$":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">$</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case "_":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">_</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, true);
				break; 
			case '"':
				if ($morse) {
					echo '"';
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, true);
				break; 
			case "@":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">@</p>', FILE_APPEND);
				}
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dash($pin, $base_time_unit, false);
				dot($pin, $base_time_unit, false);
				dash($pin, $base_time_unit ,false);
				dot($pin, $base_time_unit, true);
				break;
			case " ":
				if ($morse) { 
					file_put_contents(output,'<p style="margin:0px;">SPACE</p>', FILE_APPEND);
				}
				if ($morse && $show_sleep_time && $verbose) { 
					file_put_contents(output,'<p style="margin:100px;">Sleeping '. $base_time_unit*7 .' seconds.  </p>', FILE_APPEND);
				} elseif ($morse && $show_sleep_time) {
					file_put_contents(output,'<p style="margin:50px;">Sleeping '.$base_time_unit*7 .' seconds.  </p>', FILE_APPEND);
				}
				sleep($base_time_unit*7);
				break;
		}
		$i++;
		if ($message[$i] != " ") {
			if ($morse && $show_sleep_time && $verbose) { 
				file_put_contents(output,'<p style="margin:100px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
			} elseif ($morse && $show_sleep_time) {
				file_put_contents(output,'<p style="margin:50px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
			}
			sleep($base_time_unit*3);
		}
	}
}
function simple() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	$on_time = $_GET['on_time'];
	$off_time = $_GET['off_time'];
	$cycles = $_GET['cycles'];
	for ($i = 1; $i <= $cycles; $i++) {
		on($pin);
		if ($show_sleep_time && $verbose) {
			file_put_contents(output,'<p style="margin:50px;">Sleeping '.$on_time .' seconds.  </p>', FILE_APPEND);
		}
		sleep($on_time);
		off($pin);
		if ($show_sleep_time && $verbose) {
			file_put_contents(output,'<p style="margin:50px;">Sleeping '.$off_time .' seconds.  </p>', FILE_APPEND);
		}
		sleep($off_time);
	}
}
function ramp() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	$start_on_time = $_GET['start_on_time'];
	$end_on_time = $_GET['end_on_time'];
	$start_off_time = $_GET['start_off_time'];
	$end_off_time = $_GET['end_off_time'];
	$cycles = $_GET['cycles'];
	$on_fraction = ($end_on_time - $start_on_time) / $cycles;
	$off_fraction = ($end_off_time - $start_off_time) / $cycles;
	for ($i = 1; $i <= $cycles; $i++) {
		$on_time = $on_fraction * $i + $start_on_time;
		$off_time = $off_fraction * $i + $start_off_time;
		on($pin);
		if ($show_sleep_time && $verbose) {
			file_put_contents(output,'<p style="margin:50px;">Sleeping '.$on_time.' seconds.  </p>', FILE_APPEND);
		}
		sleep($on_time);
		off($pin);
		if ($show_sleep_time && $verbose) {
			file_put_contents(output,'<p style="margin:50px;">Sleeping '.$off_time.' seconds.  </p>', FILE_APPEND);
		}
		sleep($off_time);
	}
}
function setup() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	$command = '/usr/bin/gpio -g mode '.$pin.' out';
	$safecommand = escapeshellcmd($cmd); 
	shell_exec($safecommand);
}
function on_function() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	on($pin);
}
function off_function() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	off($pin);
}
function toggle() {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$pin = $_GET['pin'];
	$gpio = new GPIO();
	$state = $gpio-> readValuePin($pin);
	switch ($state) {
		case 0:
			on($pin);
			break;
		case 1:
			off($pin);
			break;
	}
}
function dot($pin, $base_time_unit, $last_in_letter) {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	if ($morse) {
		file_put_contents(output,'<p style="margin:0px;">DOT</p>', FILE_APPEND);
	}
	on($pin);
	if ($morse && $show_sleep_time && $verbose) { 
		file_put_contents(output,'<p style="margin:100px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
	} elseif ($morse && $show_sleep_time) {
		file_put_contents(output,'<p style="margin:50px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
	}
	off($pin);
	if ($last_in_letter != true) {
		if ($morse && $show_sleep_time && $verbose) { 
			file_put_contents(output,'<p style="margin:100px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
		} elseif ($morse && $show_sleep_time) {
			file_put_contents(output,'<p style="margin:50px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
		}
		sleep($base_time_unit);
	}
}
function dash($pin, $base_time_unit) {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$message = str_split($_GET['message'],1);
	if ($morse) {
		file_put_contents(output,'<p style="margin:0px;">DASH</p>', FILE_APPEND);
	}
	on($pin);
	if ($morse && $show_sleep_time && $verbose) { 
		file_put_contents(output,'<p style="margin:100px;">Sleeping '. $base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
	} elseif ($morse && $show_sleep_time) {
		file_put_contents(output,'<p style="margin:50px;">Sleeping '.$base_time_unit*3 .' seconds.  </p>', FILE_APPEND);
	}
	off($pin);
	if ($last_in_letter != true) {
		if ($morse && $show_sleep_time && $verbose) { 
			file_put_contents(output,'<p style="margin:100px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
		} elseif ($morse && $show_sleep_time) {
			file_put_contents(output,'<p style="margin:50px;">Sleeping '.$base_time_unit.' seconds.  </p>', FILE_APPEND);
		}
		sleep($base_time_unit);
	}
}
function on($pin) {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$gpio = new GPIO();
	$gpio->setup($pin, "out");
	$gpio->output($pin, 1);
	if ($verbose && $morse) {
		file_put_contents(output,'<p style="margin:50px;">ON</p>', FILE_APPEND);
	} elseif ($verbose && $show_sleep_time) {
		file_put_contents(output,'<p style="margin:0px;">ON</p>', FILE_APPEND);
	} elseif ($verbose){
		file_put_contents(output,'<p style="margin:0px;">ON</p>', FILE_APPEND);
	}
}
function off($pin) {
	$morse = $_GET['morse'];
	$show_sleep_time = $_GET['show_sleep_time'];
	$verbose = $_GET['verbose'];
	$gpio = new GPIO();
	$gpio->setup($pin, "out");
	$gpio->output($pin, 0);
	if ($verbose && $morse) {
		file_put_contents(output,'<p style="margin:50px;">OFF</p>', FILE_APPEND);
	} elseif ($verbose && $show_sleep_time) {
		file_put_contents(output,'<p style="margin:0px;">OFF</p>', FILE_APPEND);
	} elseif ($verbose){
		file_put_contents(output,'<p style="margin:0px;">OFF</p>', FILE_APPEND);
	}
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
