function mode() {
	var mode = document.forms[0];
	for (i = 0; i < mode.length; i++) {
		if (mode[i].checked) {
			selected_mode = i;
			var HTML = "";
			switch(selected_mode) {
				case 0: //morse
					var HTML = "<form method=POST id=\"morse\">";
					HTML += "<table nowrap>";
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12 id=\"pin\"></td></tr>";
					HTML += "<tr><td>Base Time Unit</TD><TD><input type=\"text\" name=\"BASE_TIME\" size=12 id=\"base_time_unit\"></td></tr>";
					HTML += "<tr><td>Message</TD><TD><input type=\"text\" name=\"MESSAGE\" size=12 id=\"message\"></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				case 1: //simple
					var HTML = "<form method=POST id=\"simple\">";
					HTML += "<table nowrap>";
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12></td></tr>";
					HTML += "<tr><td>On Time</TD><TD><input type=\"text\" name=\"ON_TIME\" size=12></td></tr>";
					HTML += "<tr><td>Off Time</TD><TD><input type=\"text\" name=\"OFF_TIME\" size=12></td></tr>";
					HTML += "<tr><td>Cycles</TD><TD><input type=\"text\" name=\"CYCLES\" size=12></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				case 2: //ramp
					var HTML = "<form method=POST id=\"ramp\">";
					HTML += "<table nowrap>";
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12 id=\"pin\"></td></tr>";
					HTML += "<tr><td>Start On Time</TD><TD><input type=\"text\" name=\"START_ON_TIME\" size=12 id=\"start_on_time\"></td></tr>";
					HTML += "<tr><td>Start Off Time</TD><TD><input type=\"text\" name=\"START_OFF_TIME\" size=12 id=\"start_off_time\"></td></tr>";
					HTML += "<tr><td>End On Time</TD><TD><input type=\"text\" name=\"END_ON_TIME\" size=12 id=\"end_on_time\"></td></tr>";
					HTML += "<tr><td>End Off Time</TD><TD><input type=\"text\" name=\"END_OFF_TIME\" size=12 id=\"end_off_time\"></td></tr>";
					HTML += "<tr><td>Cycles</TD><TD><input type=\"text\" name=\"CYCLES\" size=12 id=\"cycles\"></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				case 3: //setup
					var HTML = "<form method=POST id=\"setup\">";
					HTML += "<table nowrap>";
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12 id=\"pin\"></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				case 4: //on
					var HTML = "<form method=POST id=\"on\">";
					HTML += "<table nowrap>";
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12 id=\"pin\"></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				case 5: //off
					var HTML = "<form method=POST id=\"off\">";
					HTML += "<table nowrap>";
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12 id=\"pin\"></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				case 6: //toggle
					var HTML = "<form method=POST id=\"toggle\">";
					HTML += "<table nowrap>"
					HTML += "<tr><td>Pin</TD><TD><input type=\"text\" name=\"PIN\" size=12 id=\"pin\"></td></tr>";
					HTML += "</tr></table>";
					HTML += "<input type=\"button\" value=\"Execute\" onclick=\"morse()\">";
					HTML += "</form>";
					document.getElementById("options").innerHTML = HTML;
					break;
				default:
					document.getElementById("options").innerHTML = "";
					break;
			}
		break;
		}
	}
}
function morse(){
	var morse = document.forms[2];
	var pin=morse[0].value;
	var base_time_unit=morse[1].value;
	var message=morse[2].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "morse", PIN: pin, BASE_TIME_UNIT: base_time_unit, MESSAGE: message });
}
function simple(){
	var simple = document.forms[2];
	var pin=simple[0].value;
	var on_time=simple[1].value;
	var off_time=simple[2].value;
	var cycles=simple[3].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "simple", PIN: pin, ON_TIME: on_time, OFF_TIME: off_time, CYCLES: cycles });
}
function ramp(){
	var ramp = document.forms[2];
	var pin=ramp[0].value;
	var start_on_time=ramp[1].value;
	var start_off_time=ramp[2].value;
	var end_on_time=ramp[3].value;
	var end_off_time=ramp[4].value;
	var cycles=ramp[5].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "ramp", PIN: pin, START_ON_TIME: start_on_time, START_OFF_TIME: start_off_time, END_ON_TIME: end_on_time, END_OFF_TIME: end_off_time, CYCLES: cycles });
}
function setup(){
	var setup = document.forms[2];
	var pin=setup[0].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "setup", PIN: pin });
}
function on(){
	var on = document.forms[2];
	var pin=on[0].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "on", PIN: pin });
}
function off(){
	var off = document.forms[2];
	var pin=off[0].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "off", PIN: pin });
}
function toggle(){
	var toggle = document.forms[0];
	var pin =toggle[0].value;
	jQuery.get("cgi-bin/lamphtml.sh", { MODE: "toggle", PIN: pin });
}
