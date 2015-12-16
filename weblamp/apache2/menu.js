function mode() {
	var mode = document.forms[0];
	for (i = 0; i < mode.length; i++) {
		if (mode[i].checked) {
			selected_mode = mode[i].value;
			switch(selected_mode) {
				case "morse": 
					$("#simple").hide();
					$("#ramp").hide();
					$("#setup").hide();
					$("#on").hide();
					$("#off").hide();
					$("#toggle").hide();
					$("#morse").show();
					break;
				case "simple": 
					$("#morse").hide();
					$("#ramp").hide();
					$("#setup").hide();
					$("#on").hide();
					$("#off").hide();
					$("#toggle").hide();
					$("#simple").show();
					break;
				case "ramp": 
					$("#morse").hide();
					$("#simple").hide();
					$("#setup").hide();
					$("#on").hide();
					$("#off").hide();
					$("#toggle").hide();
					$("#ramp").show();
					break;
				case "setup": 
					$("#morse").hide();
					$("#simple").hide();
					$("#ramp").hide();
					$("#on").hide();
					$("#off").hide();
					$("#toggle").hide();
					$("#setup").show();
					break;
				case "on": 
					$("#morse").hide();
					$("#simple").hide();
					$("#ramp").hide();
					$("#setup").hide();
					$("#off").hide();
					$("#toggle").hide();
					$("#on").show();
					break;
				case "off": 
					$("#morse").hide();
					$("#simple").hide();
					$("#ramp").hide();
					$("#setup").hide();
					$("#on").hide();
					$("#toggle").hide();
					$("#off").show();
					break;
				case "toggle": 
					$("#morse").hide();
					$("#simple").hide();
					$("#ramp").hide();
					$("#setup").hide();
					$("#on").hide();
					$("#off").hide();
					$("#toggle").show();
					break;
				default:
					$("#morse").hide();
					$("#simple").hide();
					$("#ramp").hide();
					$("#setup").hide();
					$("#on").hide();
					$("#off").hide();
					$("#toggle").hide();
					break;
			}
		break;
		}
	}
}
function morse(){
	var morse = document.forms[2];
	var options = document.forms[1];
	var data = new Object();
	data.pin=morse[0].value;
	data.base_time_unit=morse[1].value;
	data.message=morse[2].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	$.get("lampctl.php", { mode: "morse", pin: data.pin, base_time_unit: data.base_time_unit, message: data.message, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
function simple(){
	var simple = document.forms[3];
	var options = document.forms[1];
	var data = new Object();
	data.pin=simple[0].value;
	data.on_time=simple[1].value;
	data.off_time=simple[2].value;
	data.cycles=simple[3].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	$.get("lampctl.php", { mode: "simple", pin: data.pin, on_time: data.on_time, off_time: data.off_time, cycles: data.cycles, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
function ramp(){
	var ramp = document.forms[4];
	var options = document.forms[1];
	var data = new Object();
	data.pin=ramp[0].value;
	data.start_on_time=ramp[1].value;
	data.start_off_time=ramp[2].value;
	data.end_on_time=ramp[3].value;
	data.end_off_time=ramp[4].value;
	data.cycles=ramp[5].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	$.get("lampctl.php", { mode: "ramp", pin: data.pin, start_on_time: data.start_on_time, start_off_time: data.start_off_time, end_on_time: data.end_on_time, end_off_time: data.end_off_time, cycles: data.cycles, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
function setup(){
	var setup = document.forms[5];
	var options = document.forms[1];
	var data = new Object();
	data.pin=setup[0].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	jQuery.get("lampctl.php", { mode: "setup", pin: data.pin, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
function on(){
	var on = document.forms[6];
	var options = document.forms[1];
	var data = new Object();
	data.pin=on[0].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	$.get("lampctl.php", { mode: "on", pin: data.pin, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
function off(){
	var off = document.forms[7];
	var options = document.forms[1];
	var data = new Object();
	data.pin=off[0].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	$.get("lampctl.php", { mode: "off", pin: data.pin, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
function toggle(){
	var toggle = document.forms[8];
	var options = document.forms[1];
	var data = new Object();
	data.pin =toggle[0].value;
	data.verbose=options[0].checked;
	data.show_sleep_time=options[1].checked;
	data.morse=options[2].checked;
	$.get("lampctl.php", { mode: "toggle", pin: data.pin, verbose: data.verbose, show_sleep_time: data.show_sleep_time, morse: data.morse });
	return false;
}
