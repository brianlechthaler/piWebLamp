<?php
require 'vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$read = new \React\Stream\Stream(STDIN, $loop);
$read->on('data', function ($data) use ($loop) {
	Lamp(json_decode($data, true));
});
$read->pipe(new \React\Stream\Stream(STDOUT, $loop));
$loop->run();


function Lamp($data){
	$Lamp = new Lamp\Lamp\Lamp();
	$Lamp->morse = (boolean) $data['morse'];
	$Lamp->show_sleep_time = (boolean) $data['show_sleep_time'];
	$Lamp->verbose = (boolean) $data['verbose'];
	switch ($data['mode']) {
		case "morse":
			//~ echo "Selected Morse \n";
			$Lamp->morse($data['pin'],$data['base_time_unit'],$data['message']);
			break;
		case "simple":
			//~ echo "Selected Simple \n";
			$Lamp->simple($data['pin'],$data['on_time'],$data['off_time'],$data['cycles']);
			break;
		case "ramp":
			//~ echo "Selected Ramp \n";
			$Lamp->ramp($data['pin'],$data['start_on_time'],$data['start_off_time'],$data['end_on_time'],$data['end_off_time'],$data['cycles']);
			break;
		case "setup":
			//~ echo "Selected Setup \n";
			$Lamp->setup($data['pin']);
			break;
		case "on":
			//~ echo "Selected On \n";
			$Lamp->on($data['pin']);
			break;
		case "off":
			//~ echo "Selected Off \n";
			$Lamp->off($data['pin']);
			break;
		case "toggle":
			//~ echo "Selected Toggle \n";
			$Lamp->toggle($data['pin']);
			break;
		default:
			break;
	}
}

?>
