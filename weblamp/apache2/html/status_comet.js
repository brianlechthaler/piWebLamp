function setRow(tableId, rowId, colNum, newValue) {
    $('#'+tableId).find('tr#'+rowId).find('td:eq(colNum)').html(newValue);
}
function handleResponse(data) {
		setRow("odd_pins", 3, 3, data[2][1]);
		setRow("odd_pins", 3, 4, data[2][2]);
		setRow("odd_pins", 3, 3, data[3][1]);
		setRow("odd_pins", 3, 4, data[3][2]);
		setRow("odd_pins", 3, 3, data[4][1]);
		setRow("odd_pins", 3, 4, data[4][2]);
		setRow("even_pins", 3, 3, data[7][1]);
		setRow("even_pins", 3,  4, data[7][2]);
		setRow("even_pins", 3,  3, data[8][1]);
		setRow("even_pins", 3,  4, data[8][2]);
		setRow("odd_pins", 3, 3, data[9][1]);
		setRow("odd_pins", 3, 4, data[9][2]);
		setRow("odd_pins", 3, 3, data[10][1]);
		setRow("odd_pins", 3, 4, data[10][2]);
		setRow("odd_pins", 3, 3, data[11][1]);
		setRow("odd_pins", 3, 4, data[11][2]);
		setRow("even_pins", 3, 3, data[14][1]);
		setRow("even_pins", 3, 4, data[14][2]);
		setRow("even_pins", 3, 3, data[15][1]);
		setRow("even_pins", 3, 4, data[15][2]);
		setRow("odd_pins", 3, 3, data[17][1]);
		setRow("odd_pins", 3, 4, data[17][2]);
		setRow("even_pins", 3, 3, data[18][1]);
		setRow("even_pins", 3, 4, data[18][2]);
		setRow("odd_pins", 3, 3, data[22][1]);
		setRow("odd_pins", 3, 4, data[22][2]);
		setRow("even_pins", 3, 3, data[23][1]);
		setRow("even_pins", 3, 4, data[23][2]);
		setRow("even_pins", 3, 3, data[24][1]);
		setRow("even_pins", 3, 4, data[24][2]);
		setRow("even_pins", 3, 3, data[25][1]);
		setRow("even_pins", 3, 4, data[25][2]);
		setRow("odd_pins", 3, 3, data[27][1]);
		setRow("odd_pins", 3, 4, data[27][2]);
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
eval('var data = '+transport);

handleResponse(data);
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
