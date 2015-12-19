function setRow(tableId, rowId, colNum, newValue) {
    $('#'+tableId).find('tr#'+rowId).find('td:eq(colNum)').html(newValue);
}
function handleResponse(response) {
	setRow("odd_pins", 3, 3, response[2][1]);
	setRow("odd_pins", 3, 4, response[2][2]);
	setRow("odd_pins", 5, 3, response[3][1]);
	setRow("odd_pins", 5, 4, response[3][2]);
	setRow("odd_pins", 7, 3, response[4][1]);
	setRow("odd_pins", 7, 4, response[4][2]);
	setRow("even_pins", 26, 3, response[7][1]);
	setRow("even_pins", 26,  4, response[7][2]);
	setRow("even_pins", 24,  3, response[8][1]);
	setRow("even_pins", 24,  4, response[8][2]);
	setRow("odd_pins", 21, 3, response[9][1]);
	setRow("odd_pins", 21, 4, response[9][2]);
	setRow("odd_pins", 19, 3, response[10][1]);
	setRow("odd_pins", 19, 4, response[10][2]);
	setRow("odd_pins", 23, 3, response[11][1]);
	setRow("odd_pins", 23, 4, response[11][2]);
	setRow("even_pins", 8, 3, response[14][1]);
	setRow("even_pins", 8, 4, response[14][2]);
	setRow("even_pins", 15, 3, response[15][1]);
	setRow("even_pins", 15, 4, response[15][2]);
	setRow("odd_pins", 11, 3, response[17][1]);
	setRow("odd_pins", 11, 4, response[17][2]);
	setRow("even_pins", 12, 3, response[18][1]);
	setRow("even_pins", 12, 4, response[18][2]);
	setRow("odd_pins", 15, 3, response[22][1]);
	setRow("odd_pins", 15, 4, response[22][2]);
	setRow("even_pins", 16, 3, response[23][1]);
	setRow("even_pins", 16, 4, response[23][2]);
	setRow("even_pins", 18, 3, response[24][1]);
	setRow("even_pins", 18, 4, response[24][2]);
	setRow("even_pins", 22, 3, response[25][1]);
	setRow("even_pins", 22, 4, response[25][2]);
	setRow("odd_pins", 13, 3, response[27][1]);
	setRow("odd_pins", 13, 4, response[27][2]);
}
var url = '/cgi-bin/status_comet.php';
var noerror = true;
var ajax;
function connect()
{
ajax = $.ajax(url, {
type: 'get',
data: {},
success: function(transport) {
// handle the server response
var response = JSON.parse(transport);
handleResponse(response);
noerror = true;
}, 
complete: function(transport) {
// send a new ajax request when this request is finished
if (!noerror)
// if a connection problem occurs, try to reconnect each 5 seconds
setTimeout(function(){ connect() }, 5000); 
else
connect();

noerror = false;
} 
}); 
}
function doRequest(request)
{
$.ajax(url, {
type: 'get',
data: {}
}); 
}
$(document).ready(function(){
connect();
});
