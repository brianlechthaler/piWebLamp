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
	var data = new Object();
	data.pin=morse[0].value;
	data.base_time_unit=morse[1].value;
	data.message=morse[2].value;
	$.get("cgi-bin/lamphtml.sh", { MODE: "morse", PIN: data.pin, BASE_TIME: data.base_time_unit, MESSAGE: data.message });
	return false;
}
function simple(){
	var simple = document.forms[2];
	var data = new Object();
	data.pin=simple[0].value;
	data.on_time=simple[1].value;
	data.off_time=simple[2].value;
	data.cycles=simple[3].value;
	$.get("cgi-bin/lamphtml.sh", { MODE: "simple", PIN: data.pin, ON_TIME: data.on_time, OFF_TIME: data.off_time, CYCLES: data.cycles });
	return false;
}
function ramp(){
	var ramp = document.forms[2];
	var data = new Object();
	data.pin=ramp[0].value;
	data.start_on_time=ramp[1].value;
	data.start_off_time=ramp[2].value;
	data.end_on_time=ramp[3].value;
	data.end_off_time=ramp[4].value;
	data.cycles=ramp[5].value;
	$.get("cgi-bin/lamphtml.sh", { MODE: "ramp", PIN: data.pin, START_ON_TIME: data.start_on_time, START_OFF_TIME: data.start_off_time, END_ON_TIME: data.end_on_time, END_OFF_TIME: data.end_off_time, CYCLES: data.cycles });
	return false;
}
function setup(){
	var setup = document.forms[2];
	var data = new Object();
	data.pin=setup[0].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "setup", PIN: data.pin });
	return false;
}
function on(){
	var on = document.forms[2];
	var data = new Object();
	data.pin=on[0].value;
	$.get("cgi-bin/lamphtml.sh", { MODE: "on", PIN: data.pin });
	return false;
}
function off(){
	var off = document.forms[2];
	var data = new Object();
	data.pin=off[0].value;
	$.get("cgi-bin/lamphtml.sh", { MODE: "off", PIN: data.pin });
	return false;
}
function toggle(){
	var toggle = document.forms[2];
	var data = new Object();
	data.pin =toggle[0].value;
	$.get("cgi-bin/lamphtml.sh", { MODE: "toggle", PIN: data.pin });
	return false;
}
