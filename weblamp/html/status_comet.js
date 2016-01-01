var url = '/cgi-bin/status_comet.php';
var noerror = true;
var ajax;
function connect()
{
	ajax = $.ajax(url, {
		type: 'get',
		data: {},
		success: function(response) {
			updateTable(response);
			noerror = true;
		}, 
		complete: function(transport) {
			// send a new ajax request when this request is finished
			if (!noerror)
				// if a connection problem occurs, try to reconnect each 5 seconds
				setTimeout(function(){ connect(); }, 5000); 
			else
				connect();
				noerror = false;
		} 
	}); 
}
function setRow(tableId, rowId, colNum, newValue) {
    $('#'+tableId).find('tr#'+rowId).find('td:eq(colNum)').html(newValue);
}
function updateTable(response) {
	var data = JSON.parse(response);
	setRow("odd_pins", 3, 3,    data["pin_2"][1]);
	setRow("odd_pins", 3, 4,    data[pin_2][2]);
	setRow("odd_pins", 5, 3,    data[pin_3][1]);
	setRow("odd_pins", 5, 4,    data[pin_3][2]);
	setRow("odd_pins", 7, 3,    data[pin_4][1]);
	setRow("odd_pins", 7, 4,    data[pin_4][2]);
	setRow("even_pins", 26, 3,  data[pin_7][1]);
	setRow("even_pins", 26,  4, data[pin_7][2]);
	setRow("even_pins", 24,  3, data[pin_8][1]);
	setRow("even_pins", 24,  4, data[pin_8][2]);
	setRow("odd_pins", 21, 3,   data[pin_9][1]);
	setRow("odd_pins", 21, 4,   data[pin_9][2]);
	setRow("odd_pins", 19, 3,   data[pin_10][1]);
	setRow("odd_pins", 19, 4,   data[pin_10][2]);
	setRow("odd_pins", 23, 3,   data[pin_11][1]);
	setRow("odd_pins", 23, 4,   data[pin_11][2]);
	setRow("even_pins", 8, 3,   data[pin_14][1]);
	setRow("even_pins", 8, 4,   data[pin_14][2]);
	setRow("even_pins", 15, 3,  data[pin_15][1]);
	setRow("even_pins", 15, 4,  data[pin_15][2]);
	setRow("odd_pins", 11, 3,   data[pin_17][1]);
	setRow("odd_pins", 11, 4,   data[pin_17][2]);
	setRow("even_pins", 12, 3,  data[pin_18][1]);
	setRow("even_pins", 12, 4,  data[pin_18][2]);
	setRow("odd_pins", 15, 3,   data[pin_22][1]);
	setRow("odd_pins", 15, 4,   data[pin_22][2]);
	setRow("even_pins", 16, 3,  data[pin_23][1]);
	setRow("even_pins", 16, 4,  data[pin_23][2]);
	setRow("even_pins", 18, 3,  data[pin_24][1]);
	setRow("even_pins", 18, 4,  data[pin_24][2]);
	setRow("even_pins", 22, 3,  data[pin_25][1]);
	setRow("even_pins", 22, 4,  data[pin_25][2]);
	setRow("odd_pins", 13, 3,   data[pin_27][1]);
	setRow("odd_pins", 13, 4,   data[pin_27][2]);
}
$(document).ready(function(){
connect();
});
